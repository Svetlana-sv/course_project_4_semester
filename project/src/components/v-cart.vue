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
          <input type="datetime-local" v-model="selectedDate" required>
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
          v-on:deleteCard="deleteCard"
          :name="product.product_name"
          :product_id="product.product_id"
          :quantity_name="product.quantity_name"
          :price="product.price"
          :product_image="product.product_image"
        />
        <button @click="CreateOrder" class="create_card__button">Оформить заказ</button>
        <p class="create_card__text">Итого:{{summ_price}}</p>
      </div>
    </div>
  </div>
</template>

<script>
import vCartItem from "./v-cart-item.vue";
import vCatalogItem from "./v-catalog-item.vue";
import axios from "axios";

export default {
  name: "v-cart",
  components: {
    vCartItem,
    vCatalogItem,
  },
  data() {
    //это персональные данные
    return {
      selectedDate: "",
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
      products: [
        // {
        //   id: 1,
        //   title:
        //     "Банfsddddddddddddddddddddddddddddddddddddddddddddddd fdsss f аны",
        //   price: 79.0,
        //   product_image:
        //     "https://www.pngkit.com/png/full/67-671010_milk-png-free-download-milk-in-a-pint.png",
        // },
        // {
        //   id: 2,
        //   title: "as2",
        //   price: 79.0,
        //   product_image:
        //     "https://static.tildacdn.com/tild3333-6362-4031-a631-623532386533/banan_1.png",
        // },
      ],
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
  },
  methods: {
    CreateOrder() {
      //начать оформление заказа
      if (this.$store.getters.isCustomer === true) {
        console.log("Вы авторизированы!");
        this.isClicked = true;
        console.log(this.isClicked);
      } else {
        console.log("Вы не авторизированы!");
        alert("Для оформления заказа авторизуйтесь!");
      }
    },
    inc(id,count){
      console.log(id,count);
      this.products.forEach(element => {
        if (element.product_id === id){
          element.count = count
        }
          console.log(element);
      });
    },
    deleteCard(id){
    console.log(id);
    var index = 0;
      this.products.forEach(element => {

        if (element.product_id === id){
          this.products.splice(index,1);
          
        }
        index++;
       
      //     console.log(element);
       });
    },
    MakeOrder() {
      //заказать
      var params = { customer_id: `${this.customer_id}`, last_name: `${this.last_name}`, first_name: `${this.first_name}`, middle_name: `${this.middle_name}`,
      city: `${this.city}`,street: `${this.street}`,flat: `${this.flat}`,floor: `${this.floor}`,house: `${this.house}`,
      selectedDate: `${this.selectedDate}`,selectedPay: `${this.selectedPay}`,summ_price: `${this.summ_price}`,products: this.products,};
      this.$store.commit("addCustomerData", params);
      axios
        .get("http://localhost/php/add_order.php", {
          params
        })
        .then(function (response) {
          alert('Заказ принят.');
          console.log(response);
        });
    },
  },
  computed:{
    summ_price: function(){
      var price = 0;
      this.products.forEach(element => {
        price += element.count * element.price;
      });
      return price
    }
  }
};
</script>

<style scoped>
.cart {
  max-width: 100%;
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
  width: 160px;
  border-radius: 20px;
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
.create_card__button{
  margin-top: 10px;
}
.create_card__text{
  margin-bottom: 100px;
  margin-top: 10px;
}
</style>
