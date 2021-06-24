<template>
  <div class="admin">
    <div v-if="isAutorized" class="admin__panel">
      <div class="menu">fddddddddddddd</div>
      <div class="header">gdddddddddddd</div>
      <div class="main">gdddddddddd</div>
    </div>
    <div v-else>
      <h1>Форма авторизации</h1>
      <div class="signin__form">
        <form class="form" v-on:submit.prevent="onSubmit">
          <label class="form__label">Логин:</label>
          <input
            class="form__input"
            type="text"
            v-model="login"
            required
            autofocus
            placeholder="Введите логин"
          />
          <label class="form__label">Пароль:</label>
          <input
            class="form__input"
            type="password"
            v-model="password"
            required
            placeholder="Введите пароль"
          />
          <button class="form__btn" type="submit" @click="SignIn">Войти</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "admin",
  data() {
    return {
      login: '',
      password: '',
      isAutorized: false
    };
  },
  mounted: function () {
    //this.getTableData();
  },
  methods: {
    SignIn: function () {
      var params = { login: `${this.login}`, password: `${this.password}` };
      var vm = this;
      axios
        .get("http://localhost/afanasyev-project-php/admin_signup.php", {
          params,
        })
        .then(function (response) {
          vm.isAutorized = response.data.session;
        });
    },
    // getTableData() {
    //   let vm = this;
    //   axios
    //     .get(
    //       "http://localhost/afanasyev-project-php/admin_actions.php?action=read"
    //     )
    //     .then(function (response) {
    //       if (response.data.error) {
    //         this.errorMsg = response.data.message;
    //       } else {
    //         vm.users = response.data.users;
    //       }
    //     });
    // },
  },
};
</script>

<style scoped>
.admin {
  max-width: 100%;
}
.admin__panel{
    display: grid;
  grid-template-columns: 0.5fr 1.5fr 0fr;
  grid-auto-rows: 1vmax;
  gap: 0px 0px;
  width: 100%;
  max-height: 100%;
  grid-template-areas:
    "menu header"
    "menu main";
}
.main {
  grid-area: main;
  background-color: aqua;
  bottom: 0;
}
.menu {
  grid-area: menu;
  background-color: rgb(72, 255, 0);
  height: 100%;
  bottom: 0;
}
.header {
  grid-area: header;
  background-color: rgb(255, 0, 89);
}
/* форма */
.signin__form {
  max-width: 30%;
  margin: auto;
  margin-top: 50px;
  padding: 0;
  padding: 50px;
  border: black solid 1px;
  border-radius: 20px;
}
.form {
  display: flex;
  flex-direction: column;
}
.form__label {
  text-align: left;
  margin-bottom: 5px;
}
.form__input {
  height: 35px;
  margin-bottom: 20px;
}
.form__btn {
  height: 35px;
  width: 160px;
  margin: auto;
  padding: 0;
  margin-bottom: 10px;
  font-size: var(--font--s--btn);
}
</style>