<template>
      <div class="form__customer">
        <h1>Личный кабинет</h1>

        <div class="exit_btn">
          <button @click="Exit()">Выйти</button>
        </div>

        <form action="" class="form__customer-data" v-on:submit.prevent="onSubmit">
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
        autorize_role: "",
        registr_role: ""
      };
    },
    methods: {
      Exit(){
         this.$store.commit("ChangeStatusCustomer", false);
        //console.log(this.$store.getters.isCustomer);
        router.replace("signin");
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
        var params = {
          customer_id: `${this.customer_id}`
        };
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
        this.isCustomer = this.$store.getters.isCustomer;
        this.GetData(this.$store.getters.customerData);
        this.GetOrder();
    },
  };
</script>

<style>
  .form__customer-data {
    text-align: center;
  }

  .form__customer {
    margin: auto;
    text-align: center;
    margin-bottom: 10px;
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

 

  @media screen and (max-width: 600px) {
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
</style>