<template>
  <div id="app">
    <div class="collar-navbar">
      <h1 style="color:#ffffff;padding:0;width:fit-content;margin:8px auto;">
        <a href="http://34.87.189.84/lv_collar/public">COLLAR</a>
      </h1>
    </div>
    <div class="collar-border-bar">
      <div class="collar-border">
        <h2 v-show="bool1">{{info[0]}}</h2>
        <h2 v-show="bool2">{{info[1]}}</h2>
      </div>
    </div>
    <div id="app" class="collar-container collar-mt-3">
      <form>
        <div class="collar-input-group collar-mb-3">
          <div class="collar-info">
            <h1 v-show="bool1">{{tokenID[0]}}</h1>
            <h1 v-show="bool2">{{tokenID[1]}}</h1>
          </div>
          <slot name="1">
            <textarea
              placeholder="No Information."
              name="inputtokenkey"
              id="tokenkey"
              class="collar-form-control"
              rows="1"
              readonly
            ></textarea>
          </slot>
        </div>

        <div class="collar-input-group collar-mb-3">
          <div class="collar-info">
            <h1 v-show="bool1">{{petName[0]}}</h1>
            <h1 v-show="bool2">{{petName[1]}}</h1>
          </div>
          <slot name="2">
            <textarea
              placeholder="No Information."
              name="inputdogname"
              id="petname"
              class="collar-form-control"
              rows="1"
              readonly
            ></textarea>
          </slot>
        </div>

        <div class="collar-input-group collar-mb-3">
          <div class="collar-info">
            <h1 v-show="bool1">{{ownerName[0]}}</h1>
            <h1 v-show="bool2">{{ownerName[1]}}</h1>
          </div>
          <slot name="3">
            <textarea
              placeholder="No Information."
              name="inputname"
              id="name"
              class="collar-form-control"
              rows="1"
              readonly
            ></textarea>
          </slot>
        </div>

        <div class="collar-input-group collar-mb-3">
          <div class="collar-info">
            <h1 v-show="bool1">{{addr[0]}}</h1>
            <h1 v-show="bool2">{{addr[1]}}</h1>
          </div>
          <slot name="4">
            <textarea
              placeholder="No Information."
              name="inputaddress"
              id="address"
              class="collar-form-control-address"
              rows="1"
              readonly
            ></textarea>
          </slot>
        </div>

        <div class="collar-input-group collar-mb-3">
          <div class="collar-info">
            <h1 v-show="bool1">{{tel[0]}}</h1>
            <h1 v-show="bool2">{{tel[1]}}</h1>
          </div>
          <slot name="5">
            <textarea
              placeholder="No Information."
              name="inputtel"
              id="tel"
              class="collar-form-control"
              rows="1"
              readonly
            ></textarea>
          </slot>
        </div>
      </form>
    </div>
    <div class="collar-contact">
      <img
        class="collar-contact-pic"
        src="http://34.87.189.84/lv_collar/public/pic/facebook.png"
        alt
      />
      <img
        class="collar-contact-pic"
        src="http://34.87.189.84/lv_collar/public/pic/instagram.png"
        alt
      />
      <img
        class="collar-contact-pic"
        src="http://34.87.189.84/lv_collar/public/pic/twitter.png"
        alt
      />
      <div class="collar-contact">
        <p>contact@contact.contact</p>
        <p>Tel. xxx-xxx-xxxx,xxx-xxx-xxxx</p>
        <a v-show="bool1" :style="a1" @click="changeTH">ไทย</a>
        <a v-show="bool2" :style="a2" @click="changeTH">ไทย</a>
        <a v-show="bool1" :style="a2" @click="changeEN">Eng</a>
        <a v-show="bool2" :style="a1" @click="changeEN">Eng</a>
      </div>
      <div class="collar-copybar">
        <p style="font-size:12px;margin: 12.5px 0px;">&copy; 2020 PascalDev. All rights reserved.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "app",
  methods: {
    changeEN() {
      this.bool1 = true;
      this.bool2 = false;
    },
    changeTH() {
      this.bool1 = false;
      this.bool2 = true;
    }
  },
  data() {
    return {
      a1: {
        fontSize: "14px",
        color: "#000000",
        cursor: "pointer",
        textDecoration: "none",
        margin: "3px"
      },
      a2: {
        fontSize: "14px",
        color: "#000000",
        cursor: "pointer",
        textDecoration: "underline",
        margin: "3px"
      },
      bool1: true,
      bool2: false,
      info: ["INFORMATION", "ข้อมูลการติดต่อ"],
      tokenID: ["Token ID:", "รหัสอุปกรณ์:"],
      petName: ["Pet Name:", "ชื่อสัตว์เลี้ยง:"],
      ownerName: ["Owner Name:", "ชื่อเจ้าของ:"],
      addr: ["Address:", "ที่อยู่:"],
      tel: ["Tel:", "เบอร์โทรศัพท์:"]
    };
  }
};
</script>

<style>
@import "/css/collar.css";
</style>