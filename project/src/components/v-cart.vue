<template>
  <div class="cart">
    <div v-if="isClicked">
      <form
        action=""
        class="form__customer-data"
        v-on:submit.prevent="onSubmit"
      >
        <legend>Оформление заказа</legend>
        <div class="customer-data__item">
          <label for="lastname">Фамилия:</label>
          <input
            type="text"
            placeholder="Фамилия"
            v-model="last_name"
            required
          />
        </div>
        <div class="customer-data__item">
          <label for="">Имя:</label>
          <input type="text" placeholder="Имя" v-model="first_name" required />
        </div>
        <div class="customer-data__item">
          <label for="">Отчество:</label>
          <input
            type="text"
            placeholder="Отчество"
            v-model="middle_name"
            required
          />
        </div>
        <div class="customer-data__item">
          <label for="">Город:</label>
          <input type="text" placeholder="Город" v-model="city" required />
        </div>
        <div class="customer-data__item">
          <label for="">Улица:</label>
          <input type="text" placeholder="Улица" v-model="street" required />
        </div>
        <div class="customer-data__item">
          <label for="">Дом:</label>
          <input
            type="number"
            placeholder="Дом"
            v-model="house"
            required
            :min="1"
          />
        </div>
        <div class="customer-data__item">
          <label for="">Квартира:</label>
          <input
            type="number"
            placeholder="Квартира"
            v-model="flat"
            required
            :min="1"
          />
        </div>
        <div class="customer-data__item">
          <label for="">Этаж:</label>
          <input
            type="number"
            placeholder="Этаж"
            v-model="floor"
            required
            :min="1"
          />
        </div>
        <div class="customer-data__item">
          <label for="">Способ оплаты:</label>
          <select v-model="selectedPay">
            <option disabled value="">Выберите способ оплаты</option>
            <option>Наличными</option>
            <option>Картой</option>
          </select>
        </div>
        <div class="customer-data__item">
          <label for="">Дата доставки:</label>
          <input
            type="date"
            id="myDate"
            :value="SetDate()"
            :min="SetDate()"
            required
          />
        </div>
        <button type="submit" @click="MakeOrder">Заказать</button>
      </form>
    </div>
    <div v-else>
      <div v-if="products.length === 0">
        <p>Добавьте товар</p>
      </div>
      <div v-else class="block__create_card">
        <v-cart-item
          v-for="(product, index) in products"
          :key="index"
          v-on:inc="inc"
          v-on:amount_dec="amount_dec"
          v-on:deleteCard="deleteCard"
          :name="product.product_name"
          :product_id="product.product_id"
          :quantity_name="product.quantity_name"
          :price="product.price"
          :count_product="product.amount"
          :product_image="product.product_image"

        />
        <button @click="CreateOrder" class="create_card__button">
          Оформить заказ
        </button>
        <p class="create_card__text" id="create_card__text">
          Итого: {{ summ_price.toFixed(2) }} Ꝑ
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import vCartItem from "./v-cart-item.vue";
import vCatalogItem from "./v-catalog-item.vue";
import axios from "axios";
import router from "../router/index";

export default {
  name: "v-cart",
  components: {
    vCartItem,
    vCatalogItem,
  },
  data() {
    //это персональные данные
    return {
      selectedPay: "",
      title: "card",
      isClicked: false,
      customerData: [],
      customer_id: -1,
      last_name: "",
      first_name: "",
      middle_name: "",
      city: "",
      street: "",
      house: -1,
      flat: -1,
      floor: -1,
      products: [],
    };
  },
  created() {
    this.products = this.$store.getters.cart_cards;
    this.customerData = this.$store.getters.customerData;

    this.customer_id = this.customerData.customer_id;
    this.last_name = this.customerData.last_name;
    this.first_name = this.customerData.first_name;
    this.middle_name = this.customerData.middle_name;
    this.city = this.customerData.city;
    this.street = this.customerData.street;
    this.flat = this.customerData.flat;
    this.floor = this.customerData.floor;
    this.house = this.customerData.house;

    //console.log(this.products);
  },
  methods: {
    CreateOrder() {
      //начать оформление заказа
      if (this.$store.getters.isCustomer === true) {
        this.isClicked = true;
        this.SetDate();
      } else {
        alert("Для оформления заказа необходимо авторизироваться!");
      }
    },
    SetDate() {
      var date = new Date();
      this.selectedDate = date;
      return date;
    },
    inc(id, count) {
      this.products.forEach((element) => {
        if (element.product_id === id) {
          element.count = count;
        }
      });
    },
    // amount_dec(count){
    //   return count;
    // },
    deleteCard(id) {
      var index = 0;
      this.products.forEach((element) => {
        if (element.product_id === id) {
          this.products.splice(index, 1);
        }
        index++;

        //     console.log(element);
      });
    },
    MakeOrder() {     
      var selectedDate = document.getElementById("myDate").value;
      if (selectedDate.value === "") {
        alert("Введите дату доставки!");
      } else if (this.selectedPay === "") {
        alert("Выберете способ оплаты!");
      } else {
        //заказать
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
          selectedDate: `${selectedDate}`,
          selectedPay: `${this.selectedPay}`,
          summ_price: `${this.summ_price}`,
          products: this.products,
        };
        this.$store.commit("addCustomerData", params);
        axios
          .get("http://localhost/php/add_order.php", {
            params,
          })
          .then(function (response) {
            alert("Заказ принят!");
            router.replace("/customeraccount");
            //перенаправить в лк
          });
      }
    },
  },
  computed: {
    summ_price: function () {
      var price = 0;
      this.products.forEach((element) => {
        price += element.count * element.price;
      });
      return price;
    },
  },
};
</script>

<style scoped>
.cart {
  max-width: 100%;
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
  margin: auto;
  padding: 0;
  justify-content: center;
  margin-bottom: 100px;
  align-items: center;
}
button {
  height: 35px;
  width: 175px;
  border-radius: 20px;
  font-family: 'Dela Gothic One', cursive;
  font-size: 1em;
}
/* форма */
.form__customer-data {
  text-align: center;
  margin-bottom: 100px;
}
.customer-data__item {
  display: grid;
  grid-template-columns: 0.5fr 1fr;
  text-align: left;
  margin: 5px;
}
.customer-data__item input {
  width: 300px;
  height: 30px;
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  margin: auto;
}
.customer-data__item select {
  width: 300px;
  height: 30px;
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  margin: auto;
}
.customer-data__item label {
  margin-bottom: 10px;
}
.form__customer-data button {
  margin-top: 5px;
}
legend {
  margin-bottom: 10px;
  font-size: 18px;
}
.create_card__button {
  margin: auto;
  margin-top: 10px;
  
}
.create_card__text {
  margin-bottom: 10px;
  margin-top: 10px;
}

@media screen and (max-width: 400px) {
  .customer-data__item input {
    max-width: 150px;
  }
  .customer-data__item select {
    max-width: 150px;
  }
}

@page :first {
  margin: 1cm;
}

@page :left {
  margin: 1cm 3cm 1cm 1.5cm;
}
</style>
