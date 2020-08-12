<template>
  <div id="GoogleMap">
    <div class="collar-menubar">
      <div class="collar-top-menubar">
        <h1 class="collar-h1-black">COLLAR</h1>
        <div class="collar-dropdown">
          <span class="collar-p-black">{{name}} &#x25BE;</span>
          <div class="collar-dropdown-ct">
            <button @click="logout" class="collar-border-button-wh">Logout</button>
          </div>
        </div>
      </div>
      <gmap-autocomplete
        @place_changed="setPlace"
        class="collar-form-control"
        style="width:90%;margin-bottom:10px;margin-top:56px;"
      ></gmap-autocomplete>
      <button
        @click="addMarker"
        class="collar-border-button-bk"
        :disabled="!!fetchingStatus.adding"
      >{{fetchingStatus.adding ? "Adding..." : "Add Safe Zone"}}</button>
      <!-- {{name}} -->
      <!-- {{output}} -->
      <!-- {{output[output.length - 1].safezoneid + 1}} -->
      <!-- {{safezoneid}} -->
      <hr v-if="output.length===0" />
      <p v-if="output.length===0">No Safe Zone Setting</p>
      <table v-else style="width:100%;text-align:center;margin-top:10px;">
        <thead>
          <tr>
            <!-- <th>Safe Zone Id</th> -->
            <!-- <th>Travel</th> -->
            <th>Safe Zone Name</th>
            <th>Radius</th>
            <th>Remove</th>
            <th>Travel</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="info in output" :key="info.id">
            <!-- <th>{{info.safezoneid}}</th> -->
            <td>
              <input class="collar-td-text" type="text" v-model="info.safezonename" />
            </td>
            <td>
              <input class="collar-td-text" style="width:50px" type="text" v-model="info.radius" />
            </td>
            <td>
              <button class="collar-td-text" @click="removeSafeZone(info.id)">X</button>
            </td>
            <td>
              <button
                class="collar-td-text"
                @click="changeCoor({lat: Number(info.lat), lng: Number(info.lng)});options.zoom=20"
              >Go</button>
            </td>
            <td>
              <button
                class="collar-td-text"
                @click="saveEdit(info.id,info.safezonename,info.radius)"
              >Save</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="collar-map">
      <gmap-map
        ref="mapRef"
        :center="{ lat: 13.756606, lng: 100.501506 }"
        :options="options"
        style="width:100%;height:100%;position:absolute;"
        @center_changed="update('reportedCenter', $event)"
        @idle="bounce()"
        @zoom_changed="updateZoom()"
      >
        <gmap-marker
          ref="markerRef"
          :position="reportedCenter"
          :clickable="false"
          :draggable="false"
        ></gmap-marker>
        <div v-for="info in output" :key="info.id">
          <gmap-marker
            @click="show=true;changeCoor({lat: Number(info.lat), lng: Number(info.lng)});options.zoom=20"
            :icon="{url:'/pic/baseline_home_black_18dp.png'}"
            :position="{lat: Number(info.lat), lng: Number(info.lng)}"
            :clickable="true"
            :draggable="false"
          >
            <gmap-info-window @closeclick="show=false" :opened="show">{{info.safezonename}}</gmap-info-window>
          </gmap-marker>
          <gmap-circle
            v-if="options.zoom>=18"
            :center="{lat: Number(info.lat), lng: Number(info.lng)}"
            :radius="info.radius"
          ></gmap-circle>
        </div>
      </gmap-map>
    </div>
  </div>
</template>

<script>
const FETCH_STATUS = {
  IDLE: 0,
  FETCHING: 1
};

export default {
  name: "GoogleMap",
  data() {
    return {
      show: true,
      output: [],
      name: "",
      reportedCenter: { lat: 13.756606, lng: 100.501506 },
      options: {
        zoom: 17,
        minZoom: 10,
        maxZoom: 21,
        panControl: true,
        mapTypeControl: false,
        fullscreenControl: false,
        styles: [
          {
            featureType: "poi.business",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "poi.park",
            elementType: "labels.text",
            stylers: [
              {
                visibility: "off"
              }
            ]
          }
        ]
      },
      markers: [],
      currentPlace: null,
      fetchingStatus: {
        adding: FETCH_STATUS.IDLE
      }
    };
  },
  created() {
    this.geolocate();
    this.refresh();
    this.username();
  },
  methods: {
    username() {
      axios.post("/api/navbar/name").then(response => {
        this.name = response.data.name;
      });
    },
    logout() {
      axios.post("/logout").then(response => {
        location.reload();
      });
    },
    refresh(from) {
      axios.post("/api/safezone/get").then(response => {
        this.output = response.data.data;
        if (from) this.fetchingStatus[from] = FETCH_STATUS.IDLE;
      });
    },
    changeCoor(coor) {
      this.$refs.mapRef.$mapPromise.then(map => {
        map.panTo(coor);
        this.reportedCenter = coor;
      });
    },
    bounce() {
      this.$refs.markerRef.$markerObject.setAnimation(
        google.maps.Animation.BOUNCE
      );
      setTimeout(() => {
        this.$refs.markerRef.$markerObject.setAnimation(null);
      }, 0);
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.changeCoor({
          lat: position.coords.latitude,
          lng: position.coords.longitude
        });
      });
    },
    update(field, event) {
      switch (field) {
        case "reportedCenter":
          this.reportedCenter = {
            lat: event.lat(),
            lng: event.lng()
          };
          break;
        case "bounds":
          this.mapBounds = event;
          break;
        default:
          this.$set(this, field, event);
      }
    },
    setPlace(place) {
      this.currentPlace = place;
      this.travel();
    },
    travel() {
      this.changeCoor({
        lat: this.currentPlace.geometry.location.lat(),
        lng: this.currentPlace.geometry.location.lng()
      });
    },
    addMarker() {
      this.fetchingStatus.adding = FETCH_STATUS.FETCHING;
      this.options.zoom = 20;
      if (
        !this.output.some(
          e =>
            Math.sqrt(
              Math.pow(e.lat - this.reportedCenter.lat, 2) +
                Math.pow(e.lng - this.reportedCenter.lng, 2)
            ) <= 1e-5
        )
      ) {
        axios
          .post("/api/safezone/add", {
            safezonename: "Rename",
            radius: 25,
            lat: this.reportedCenter.lat,
            lng: this.reportedCenter.lng
          })
          .then(_ => this.refresh("adding"))
          .catch(e => {
            alert("เกิดข้อผิดพลาดขึ้น: " + e.message);
            this.fetchingStatus.adding = FETCH_STATUS.IDLE;
          });
      } else {
        alert("ไม่สามารถเลือกตำแหน่งเดิมได้");
        this.fetchingStatus.adding = FETCH_STATUS.IDLE;
      }
    },
    updateZoom() {
      this.$refs.mapRef.$mapPromise.then(map => {
        this.options.zoom = map.getZoom();
      });
    },
    removeSafeZone(x) {
      axios
        .post("/api/safezone/delete", {
          id: x
        })
        .then(_ => this.refresh("deleting"));
    },
    saveEdit(x, y, z) {
      axios
        .post("/api/safezone/edit", {
          id: x,
          safezonename: y,
          radius: z
        })
        .then(_ => this.refresh("editing"));
    }
  }
};
</script>

<style>
table,
th,
td {
  border: 1px solid #e5e5e5;
  border-collapse: collapse;
}
input {
  width: 100px;
}
</style>