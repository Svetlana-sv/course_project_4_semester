<template>
  <div class="autorize__form">
    <div class="signin__form">
      <form class="form" v-on:submit.prevent="onSubmit">
        <legend>Форма авторизации и регистрации</legend>

        <div class="autorize__form__radio">
          <div class="form__radio__item">Выбирите роль:</div>
          <div class="form__radio__item">
            <input type="radio" id="autorize_role1" value="customer" v-model="autorize_role">
            <label for="autorize_role1">Покупатель</label>
          </div>
          <div class="form__radio__item">
            <input type="radio" id="autorize_role2" value="manager" v-model="autorize_role">
            <label for="autorize_role2">Менеджер</label>
          </div>


        </div>

        <label class="form__label">Введите номер мобильного телефона:</label>
        <input class="form__input" type="text" v-model="login" required autofocus placeholder="7 ХХХ ХХХ ХХ ХХ" />
        <label class="form__label">Введите пароль:</label>
        <input class="form__input" type="password" v-model="password" required placeholder="Введите пароль" />
        <button class="form__btn" type="submit" @click="SignIn">Войти</button>
        <button class="form__btn" type="submit" @click="SignUp">Зарегистрироваться</button>
      </form>
    </div>
  </div>
</template>

<script>
  import axios from "axios";
  import router from '../router';

  export default {
    name: "SignIn",
    data() {
      return {
        login1: "",
        password1: "",
        login: "",
        password: "",
        role: "",
        customerData: [],
        orders: [],
        customer_id: -1,
        last_name: "",
        first_name: "",
        middle_name: "",
        city: "",
        street: "",
        house: -1,
        flat: -1,
        floor: -1,
        autorize_role: "",
        registr_role: ""
      };
    },
    methods: {
      SignIn() {
        //проверка введенных данных на корректность
        if (this.autorize_role === "") {
          alert("Для авторизации необходимо выбрать роль!");
          return 0;
        }
        if (this.login === "" ||
          this.password === "" ||
          this.login.length != 11) {
          alert(
            "Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX"
          );
        } else {
          let vm = this;
          let params = {
            login: `${this.login}`,
            password: `${this.password}`,
            role: `${this.autorize_role}`
          };
          axios
            .get("http://localhost/php/signin_customer.php", { //отправление запроса на сервер
              params,
            })
            .then(function (response) {
              console.log(response);
              if (response.data.session) {
                if (response.data.role === "customer") {
                  vm.$store.commit("ChangeStatusCustomer", response.data.session);
                  vm.$store.commit("addCustomerData", response.data.data);
                  router.replace("customeraccount");
                } else if (response.data.role === "manager") {
                  vm.$store.commit("ChangeStatusManager", response.data.session);
                  vm.$store.commit("addManagerData", response.data.data);
                  console.log("Sign in ",response.data.data);
                  router.replace("manageraccount");
                }
              } else {
                alert("Введите корректные данные!");
              }
            });
        }
      },
      SignUp: function () {
        if (this.registr_role === "") {
          alert("Для регистрации необходимо выбрать роль!");
          return 0;
        }
        if (
          this.login1 === "" ||
          this.password1 === "" ||
          this.login1.length != 11
        ) {
          alert(
            "Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX"
          );
          return 0;
        }
        let params = {
          login: `${this.login1}`,
          password: `${this.password1}`,
          role: `${this.registr_role}`
        };
        axios
          .get("http://localhost/php/signup_customer.php", {
            params,
          })
          .then(function (response) {
            if (response.data.signup) {
              alert("Вы успешно зарегистрированы!");
              if (response.data.role === "customer") {
                vm.isCustomer = response.data.session;
                vm.$store.commit("ChangeStatusCustomer", response.data.session);
                router.replace("customeraccount");
              } else if (response.data.role === "manager") {
                vm.$store.commit("ChangeStatusManager", response.data.session);
                router.replace("manageraccount");
              }
            } else {
              alert("Номер телефона уже зарегистрирован!");
            }
          });
      }
    }
  };
</script>

<style>
  #v-footer {
    display: block;
  }

  .signin {
    max-width: 100%;
    min-height: 100%;
    text-align: center;
  }

  .autorize__form {
    margin-top: 40px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
  }

  .autorize__form__radio {
    display: flex;
    flex-direction: row;
    justify-content: center;
    padding: 15px;
  }
  .form__radio__item{
    padding: 5px;
  }

  .signin__form {
    width: 60%;
    margin: 0px;
    padding: 0;
    padding: 10px 50px 50px 50px;
    border: rgb(10, 191, 0) solid 1px;
    border-radius: 20px;
  }

  .signin__form legend {
    padding: 15px;
    font-weight: bold;
    font-size: 1.4em;
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
    background: #e9eff6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    padding: 0 20px;
  }

  .form__btn {
    height: 40px;
    width: 180px;
    margin: auto;
    padding: 0;
    background: rgb(94, 225, 87);
    margin-bottom: 10px;
    font-size: var(--font--s--btn);
  }

  button {
    height: 35px;
    width: 175px;
    border-radius: 20px;
  }

  @media screen and (max-width: 600px) {
    .signin__form {
      margin: auto;
      padding: 0;
      min-width: 100%;
      margin-top: 20px;
    }

    .form__input {
      max-width: 100%;
      margin: auto;
      margin: 10px;
    }

    .form__label {
      padding: 10px;
    }

    .form {
      padding: 10px;
    }
  }



  @media screen and (max-width: 600px) {
     .autorize__form__radio {
    flex-direction: column;}
  }

  @media screen and (min-width: 1920px) {
    .signin__form {
      max-width: 678px;
    }
  }

  @media screen and (max-width: 1000px) {
    .autorize__form {
      flex-direction: column;
    }

    .signin__form {
      margin-bottom: 10px;
    }
  }
</style>