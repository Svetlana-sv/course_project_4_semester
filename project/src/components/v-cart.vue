<template>
  <div class="cart">
    <v-cart-item
      v-for="(product, index) in products"
      :key="index"
      :name="product.product_name"
      :price="product.price"
      :product_image="product.product_image"
    />
    <button @click="CreateOrder">Оформить заказ</button>
  </div>
</template>

<script>
import vCartItem from "./v-cart-item.vue";
import vCatalogItem from "./v-catalog-item.vue";

export default {
  name: "v-cart",
  components: {
    vCartItem,
    vCatalogItem,
  },
  data() {
    //это персональные данные
    return {
      title: "card",
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
  },
  methods: {
    CreateOrder() {
      if (this.$store.getters.isCustomer===true) {
        console.log("Вы авторизированы!");
      } else {
        console.log("Вы не авторизированы!");
        alert('Для оформления заказа авторизуйтесь!');
      }
    },
  },
};
</script>

<style scoped>
.cart {
  max-width: 100%;
  display: flex;
  flex-direction: column;
  margin: auto;
  padding: 15px 0;
  align-items: center;
}
button {
  height: 35px;
  width: 160px;
  border-radius: 20px;
}
</style>
