<template>
  <div id="try">
    {{info}}
    <hr />
    <form @submit="send">
      <input type="text" v-model="deviceid" placeholder="deviceid" />
      <input type="text" v-model="latitude" placeholder="latitude" />
      <input type="text" v-model="longtitude" placeholder="longtitude" />
      <button type="submit">Submit</button>
    </form>
    <hr />
    <form @submit="search">
      <input type="text" v-model="deviceid2" placeholder="deviceid" />
      <button type="submit">Search</button>
    </form>
    <hr />
    <form @submit="something">
      <input type="text" v-model="id" placeholder="id" />
      <button type="submit">Enter</button>
    </form>
    <hr />
    <form @submit="remove">
      <input type="text" v-model="logid2" placeholder="logid" />
      <button type="submit">Delete</button>
    </form>
    <hr />
    {{output}}
    <table style="width:100%;text-align:center;">
      <tr>
        <th>logid</th>
        <th>deviceid</th>
        <th>latitude</th>
        <th>longtitude</th>
        <th>Delete</th>
      </tr>
      <tr v-for="el in output.logdata" :key="el">
        <td>
          <p>{{el.logid}}</p>
        </td>
        <td>
          <p>{{el.deviceid}}</p>
        </td>
        <td>
          <p>{{el.latitude}}</p>
        </td>
        <td>
          <p>{{el.longtitude}}</p>
        </td>
        <td>
          <button @click="removeX(el.logid)">X</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  name: "try",
  data() {
    return {
      info: null,
      output: [],
      id: "",
      deviceid: "",
      deviceid2: "",
      logid: "",
      logid2: "",
      latitude: "",
      longtitude: ""
    };
  },
  mounted() {
    axios.post("/try/api").then(response => (this.info = response.data));
  },
  methods: {
    something(e) {
      e.preventDefault();
      let currentObj = this;
      axios
        .post("/try/email", {
          id: this.id
        })
        .then(function(response) {
          currentObj.output = response.data;
        })
        .catch(function(error) {
          currentObj.output = error;
        });
      //this.refresh();
    },
    refresh() {
      let currentObj = this;
      axios.post("/try/api").then(response => (this.info = response.data));
      axios
        .post("/try/searchapi", {
          deviceid: this.deviceid2
        })
        .then(function(response) {
          currentObj.output = response.data;
        });
    },
    send(e) {
      e.preventDefault();
      let currentObj = this;
      axios.post("/try/vueapi", {
        deviceid: this.deviceid,
        latitude: this.latitude,
        longtitude: this.longtitude
      });
      this.refresh();
    },
    search(e) {
      e.preventDefault();
      let currentObj = this;
      axios
        .post("/try/searchapi", {
          deviceid: this.deviceid2
        })
        .then(function(response) {
          currentObj.output = response.data;
        })
        .catch(function(error) {
          currentObj.output = error;
        });
      this.refresh();
    },
    remove(e) {
      e.preventDefault();
      let currentObj = this;
      axios.post("/try/destroyapi", {
        logid: this.logid2
      });
      this.refresh();
    },
    removeX(e) {
      this.logid = e;
      let currentObj = this;
      axios.post("/try/destroyapi", {
        logid: this.logid
      });
      this.refresh();
    }
  }
};
</script>

<style>
input,
button {
  font-size: 20px;
}
</style>