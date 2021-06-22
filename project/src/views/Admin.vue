<template>
  <div class="admin">
  <div class="menu">
fddddddddddddd
  </div>
  <div class="header">
    gdddddddddddd
  </div>
  <div class="main">
    gdddddddddd
  </div></div>
</template>

<script>
import axios from "axios";

export default {
  name: "admin",
  data() {
    return {
      errorMsg: "",
      successMsg: "",
      users: [],
      isAutorized: false,
    };
  },
  mounted: function () {
    //this.getTableData();
  },
  methods: {
    TrySignUp: function () {
      var login = document.getElementById("admin_login").value;
      let password = document.getElementById("admin_password").value;
      let params = { login: `${login}`, password: `${password}` };
      let vm = this;
      axios
        .get("http://localhost/afanasyev-project-php/admin_signup.php", {
          params,
        })
        .then(function (response) {
          vm.isAutorized = response.data.session;
        });
    },
    getTableData() {
      let vm = this;
      axios
        .get(
          "http://localhost/afanasyev-project-php/admin_actions.php?action=read"
        )
        .then(function (response) {
          if (response.data.error) {
            this.errorMsg = response.data.message;
          } else {
            vm.users = response.data.users;
          }
        });
    },
  },
};
</script>

<style scoped>
.admin {
    display: grid; 
  grid-template-columns: 0.5fr 1.5fr 0fr; 
  grid-auto-rows:1vmax;
  gap: 0px 0px; 
  width: 100%;
  max-height: 100%;
  grid-template-areas: 
    "menu header"
    "menu main";
}
.main{
  grid-area: main;
  background-color: aqua;
  bottom: 0;
}
.menu{

  grid-area: menu;
  background-color: rgb(72, 255, 0);
  height: 100%;
  bottom: 0;
}
.header{
  grid-area: header;
  background-color: rgb(255, 0, 89);
}
</style>