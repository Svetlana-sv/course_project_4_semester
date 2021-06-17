<template>
  <div class="main">
    <h1 class="form__title">Страница Администратора</h1>
    <p class="main__options">
      Если Вы не администратор нашего сайта, пожалуйста покиньте данную страницу
    </p>
    <div v-if="isAutorized">
      <div v-for="(user, index) in users" :key="index">
        <p>{{ index }}</p>
        <p>{{ user.name }}</p>
      </div>
    </div>
    <div class="main__container" v-else>
      <form class="container__form">
        <div class="form__item">
          <label class="item__label"> Логин: </label>
          <input
            id="admin_login"
            class="item__input"
            type="text"
            placeholder=""
          />
        </div>

        <div class="form__item">
          <label class="item__label"> Пароль: </label>
          <input
            id="admin_password"
            class="item__input"
            type="password"
            placeholder=""
          />
        </div>

        <div class="form__item row">
          <router-link to="/"
            ><button class="item__button">На Главную</button></router-link
          >
          <button @click="TrySignUp" class="item__button">Войти</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "admin",
  data() {
    return {
      errorMsg: "",
      successMsg: "",
      users: [
        {
          name: "Кирилл",
          surname: "Афанасьев",
          telethone: "8 (919)-312-12-22",
        },
        {
          name: "Кирилл",
          surname: "Афанасьев",
          telethone: "8 (919)-312-12-22",
        },
        {
          name: "Кирилл",
          surname: "Афанасьев",
          telethone: "8 (919)-312-12-22",
        },
      ],
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
        .get("http://localhost/afanasyev-project-php/admin_actions.php?action=read")
        .then(function (response) {
          if (response.data.error) {
            this.errorMsg = response.data.message;
          } else {
            vm.users = response.data.users;
          }
        });
    }
  },
};
</script>

<style scoped>
.container__form {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  padding: 60px 5%;
  gap: 20px;
  border-radius: 10px;
  border: 2px solid var(--color-primary);
}
.form__item {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
}
.main__container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
form input {
  padding: 8px 10px;
  margin-top: 5px;
  border-radius: 5px;
  border: 1px solid black;
  outline: none;
}
.row {
  margin-top: 30px;
  width: 100%;
  flex-direction: row;
  justify-content: space-between;
}

.main {
  display: flex;
  flex-direction: column;
  gap: 50px;
  justify-content: space-between;
}
.main__options {
  /* margin-top: 15%; */
  text-align: center;
}
/* @media  (max-width: 600px) {
    .main__options{
      margin-top: 10%;
    }
} */
</style>