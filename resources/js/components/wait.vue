<template>
  <div id="app">
    <div v-bind:style="divtop">
      <h1 @click.alt="bool=!bool" style="color:#ffffff;padding:0px;margin: 10px 0px;">COLLAR</h1>
      <a v-if="bool" href="http://127.0.0.1:8000/home">SURE?</a>
    </div>
    <div v-bind:style="divmid">
      <h1 v-bind:style="h1">COMING SOON</h1>
      <hr v-bind:style="hr" />
      <h1 style="color:#ffffff;font-weight:400;font-size:25px;padding:0;">{{timestamp}}</h1>
    </div>
    <div v-bind:style="divbot">
      <p
        style="color:#ffffff;font-size:12px;margin: 10px 0px;"
      >&copy; 2020 PascalDev. All rights reserved.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "app",
  data() {
    return {
      bool: false,
      timestamp: "",
      hr: {
        border: "2px solid white",
        marginTop: "20px",
        marginBottom: "20px",
        width: "40%"
      },
      h1: {
        color: "#ffffff",
        fontSize: "60px",
        fontWeight: "600",
        padding: "0",
        margin: "10px 0px"
      },
      divmid: {
        position: "absolute",
        top: "50%",
        left: "50%",
        transform: "translate(-50%, -50%)",
        textAlign: "center"
      },
      divtop: {
        position: "absolute",
        top: "0",
        left: "16px"
      },
      divbot: {
        position: "absolute",
        bottom: "0",
        left: "16px"
      }
    };
  },
  mounted() {
    setInterval(this.getNow, 1000);
  },
  methods: {
    getNow: function() {
      const today = new Date();
      const goal = new Date(2020, 6, 13);
      const date =
        (goal.getFullYear() - today.getFullYear()) * 365 +
        (goal.getMonth() - today.getMonth()) * 31 +
        (goal.getDate() - today.getDate()) +
        "d";
      const time =
        23 -
        today.getHours() +
        "h" +
        "\xa0\xa0" +
        (59 - today.getMinutes()) +
        "m" +
        "\xa0\xa0" +
        (59 - today.getSeconds()) +
        "s";
      const dateTime = date + "\xa0\xa0" + time + "\xa0\xa0" + "left";
      this.timestamp = dateTime;
    }
  }
};
</script>

<style>
@import "/css/collar.css";
</style>