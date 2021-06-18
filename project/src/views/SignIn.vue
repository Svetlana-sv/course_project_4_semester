<template>
  <div class="signin">
    <h1>Форма авторизации</h1>
    <div class="signin__form">
      <form action="api.php" class="form">
        <label class="form__label">Логин:</label>
        <input
          class="form__input"
          type="text"
          id="login"
          name="login"
          v-model="login"
          required
          autofocus
          placeholder="Введите логин"
        />
        <label class="form__label">Пароль:</label>
        <input
          class="form__input"
          type="password"
          id="password"
          name="password"
          v-model="password"
          required
          placeholder="Введите пароль"
        />
        <button class="form__btn" type="submit" @click="SignIn">Войти</button>
        <a href="#">Регистрация...</a>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SignIn",
  data() {
    return {
      login: "",
      password: "",
    };
  },
  methods: {
    SignIn() {
      if (this.password.length > 0) {
        axios.get("http://localhost/php/signin_customer.php", {
            login: this.login,
            password: this.password,
          })
          .then((response) => {
            let is_admin = response.data.user.is_admin;
            localStorage.setItem("user", JSON.stringify(response.data.user));
            localStorage.setItem("jwt", response.data.token);

            if (localStorage.getItem("jwt") != null) {
              this.$emit("loggedIn");
              if (this.$route.params.nextUrl != null) {
                this.$router.push(this.$route.params.nextUrl);
              } else {
                if (is_admin == 1) {
                  this.$router.push("admin");
                } else {
                  this.$router.push("dashboard");
                }
              }
            }
          })
          .catch(function (error) {
            console.error(error.response);
          });
      }
    },
  },
};
</script>

<style scoped>
.signin {
  max-width: 100%;
  min-height: 100%;
}
.signin__form {
  width: 20%;
  margin: auto;
  margin-top: 100px;
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

