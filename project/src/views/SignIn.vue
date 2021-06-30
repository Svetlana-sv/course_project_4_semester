<template>
  <div class="signin">
    <div v-if="isCustomer">
      <div class="form__customer">
        <h1>Личный кабинет</h1>

        <form
          action=""
          class="form__customer-data"
          v-on:submit.prevent="onSubmit"
        >
          <legend>Персональные данные</legend>
          <div class="customer-data__item">
            <label for="lastname">Фамилия:</label>
            <input type="text" placeholder="Фамилия" v-model="last_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Имя:</label>
            <input type="text" placeholder="Имя" v-model="first_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Отчество:</label>
            <input type="text" placeholder="Отчество" v-model="middle_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Город:</label>
            <input type="text" placeholder="Город" v-model="city" />
          </div>
          <div class="customer-data__item">
            <label for="">Улица:</label>
            <input type="text" placeholder="Улица" v-model="street" />
          </div>
          <div class="customer-data__item">
            <label for="">Дом:</label>
            <input type="number" placeholder="Дом" v-model="house" />
          </div>
          <div class="customer-data__item">
            <label for="">Квартира:</label>
            <input type="number" placeholder="Квартира" v-model="flat" />
          </div>
          <div class="customer-data__item">
            <label for="">Этаж:</label>
            <input type="number" placeholder="Этаж" v-model="floor" />
          </div>
          <button type="submit" @click="SaveData">Сохранить</button>
        </form>
      </div>
      <p>Мои заказы</p>
      <div class="table-wrap">
        <table class="table-2">
          <tr>
            <td>Дата заказа</td>
            <td>Метод оплаты</td>
            <td>Дата доставки</td>
            <td>Сумма заказа</td>
          </tr>
          <tr v-for="(order, index) in orders" :key="index">
            <td>{{ order.order_data }}</td>
            <td>{{ order.payment_method }}</td>
            <td>{{ order.delivery_data }}</td>
            <td>{{ order.order_price }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div v-else id="autorize">
      <h1>Форма авторизации</h1>
      <div class="signin__form">
        <form class="form" v-on:submit.prevent="onSubmit">
          <label class="form__label">Номер мобильного телефона:</label>
          <input
            class="form__input"
            type="text"
            v-model="login"
            required
            autofocus
            placeholder="Введите номер"
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
      <div id="registration">
        <h1>Форма регистрации</h1>
        <div class="signin__form">
          <form class="form" v-on:submit.prevent="onSubmit">
            <label class="form__label"
              >Введите номер мобильного телефона:</label
            >
            <input
              class="form__input"
              type="text"
              v-model="login1"
              required
              autofocus
              placeholder="Введите номер"
            />
            <label class="form__label">Придумайте пароль:</label>
            <input
              class="form__input"
              type="password"
              v-model="password1"
              required
              placeholder="Введите пароль"
            />
            <button class="form__btn" type="submit" @click="SignUp">
              Зарегистрироваться
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SignIn",
  data() {
    return {
      login1: "",
      password1: "",
      login: "",
      password: "",
      isCustomer: false,
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
    };
  },
  methods: {
    SignIn() {
      if (//проверка введенных данных на корректность
        this.login === "" ||
        this.password === "" ||
        this.login.length != 11
      ) {
        alert(
          "Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX"
        );
      } else {
        let vm = this;
        let params = { login: `${this.login}`, password: `${this.password}` };
        axios
          .get("http://localhost/php/signin_customer.php", {//отправление запроса на сервер
            params,
          })
          .then(function (response) {
            if (response.data.session) {
              vm.isCustomer = response.data.session;
              if (response.data.session) {
                vm.GetData(response.data.data);
                vm.GetOrder();
                vm.customerData = response.data.data;
                vm.$store.commit("addCustomerData", response.data.data);
                vm.$store.commit("changeStatus", vm.isCustomer);
                var r = document.getElementById("registration");
                r.style.display = "none";
              } else {
                alert("Введите корректные данные!");
              }
            }
          });
      }
    },
    SignUp: function () {
      if (
        this.login1 === "" ||
        this.password1 === "" ||
        this.login1.length != 11
      ) {
        alert(
          "Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX"
        );
        return;
      }
      let params = { login: `${this.login1}`, password: `${this.password1}` };
      axios
        .get("http://localhost/php/signup_customer.php", {
          params,
        })
        .then(function (response) {
          console.log(response.data.signup);
          if (response.data.signup) {
            alert("Вы успешно зарегистрированы!");
            var r = document.getElementById("registration");
            r.style.display = "none";
          } else {
            alert("Номер телефона уже зарегистрирован!");
          }
        });
    },
    SaveData() {
      var params = {
        customer_id: `${this.customer_id}`,
        last_name: `${this.last_name}`,
        first_name: `${this.first_name}`,
        middle_name: `${this.middle_name}`,
        city: `${this.city}`,
        street: `${this.street}`,
        flat: `${this.flat}`,
        floor: `${this.floor}`,
        house: `${this.house}`,
      };
      this.$store.commit("addCustomerData", params);
      axios
        .get("http://localhost/php/save_data_customer.php", {
          params,
        })
        .then(function (response) {
          alert("Данные успешно изменены!");
          console.log(response);
        });
    },
    GetData(data) {
      this.customer_id = data.customer_id;
      this.last_name = data.last_name;
      this.first_name = data.first_name;
      this.middle_name = data.middle_name;
      this.city = data.city;
      this.street = data.street;
      this.flat = data.flat;
      this.floor = data.floor;
      this.house = data.house;
    },
    GetOrder() {
      let vm = this;
      var params = { customer_id: `${this.customer_id}` };
      axios
        .get("http://localhost/php/get_order.php", {
          params,
        })
        .then(function (response) {
          console.log(response);
          vm.orders = response.data.orders;
        });
    },
  },
  created() {
    console.log("created");
    this.isCustomer = this.$store.getters.isCustomer;
    if (this.isCustomer) {
      this.GetData(this.$store.getters.customerData);
      this.GetOrder();
    }
  },
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
.signin__form {
  max-width: 30%;
  margin: auto;
  margin-top: 50px;
  padding: 0;
  padding: 50px;
  border: rgb(10, 191, 0) solid 1px;
  border-radius: 20px;
}
/**/
.form__customer-data {
  text-align: center;
  margin-bottom: 15px;
}
.form__customer {
  margin: auto;
  text-align: center;
  margin-bottom: 100px;
}
.customer-data__item {
  display: flex;
  flex-direction: column;
  text-align: center;
  margin: 10px;
}
.customer-data__item input {
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  width: 70%;
  height: 30px;
  margin: auto;
}
.customer-data__item label {
  margin-bottom: 10px;
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
  height: 35px;
  width: 160px;
  margin: auto;
  padding: 0;
  background: rgb(94, 225, 87);
  margin-bottom: 10px;
  font-size: var(--font--s--btn);
}

button {
  height: 35px;
  width: 160px;
  border-radius: 20px;
  margin-bottom: 80px;
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

/* стили для таблицы */
table.table-2 {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}
table.table-2 tr {
  background-color: #f8f8f8;
}
table.table-2 th,
table.table-2 td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
}

table.table-2 th {
  font-weight: bold;
}

@media screen and (max-width: 600px) {
  table.table-2 tr {
    display: block;
  }
  table.table-2 tr {
    margin-bottom: 30px;
  }
  table.table-2 th,
  table.table-2 td {
    display: block;
    text-align: center;
  }
}

@media screen and (min-width: 1920px) {
  .signin__form {
    max-width: 678px;
  }
}
</style>

