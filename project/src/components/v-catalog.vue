<template>
  <div class="v-catalog">
    <div class="search">
      <input
        class="search__input"
        type="text"
        placeholder="Поиск"
        v-model="search"
      />
    </div>

    <div class="category">
      <h1>Категория</h1>
      <div
        class="category__products"
        v-for="(category, index) in category_products"
        :key="index"
      >
        <a class="category__products_item">{{ category.name_category }}</a>
      </div>
      <h1>Магазин</h1>
      <div class="category__shops_item"
      v-for="(shop, index) in shops"
          :key="index"
      >
        <input
          class="category__checkbox"
          type="checkbox"
          :id="shop.shop_name"
          v-model="checked"
        />
        <label :for="shop.shop_name">{{shop.shop_name}}</label>
      </div>
    </div>

    <div class="items">
      <div class="v-catalog__list">
        <v-catalog-item
          :name="food.title"
          :price="food.price"
          :product_image="food.product_image"
          v-for="(food, index) in filter_products"
          :key="index"
        />
         <v-catalog-item
          :name="food.title"
          :price="food.price"
          :product_image="food.product_image"
          v-for="(food, index) in filter_products"
          :key="index"
        />
         <v-catalog-item
          :name="food.title"
          :price="food.price"
          :product_image="food.product_image"
          v-for="(food, index) in filter_products"
          :key="index"
        />
      </div>
    </div>
  </div>
</template>

<script>
import vCatalogItem from "./v-catalog-item.vue";
import vPopup from "./v-popup.vue";
import axios from "axios";

export default {
  name: "v-catalog",
  components: {
    vCatalogItem,
    vPopup,
  },
  data() {
    //это персональные данные
    return {
      search: '',
      products: [
        {
          id: 1,
          title: "Банfsddddddddddddddddddddddddddddddddddddddddddddddd fdsss f аны",
          price: 79.0,
          product_image: 'https://www.pngkit.com/png/full/67-671010_milk-png-free-download-milk-in-a-pint.png'
        },
        {
          id: 2,
          title: "as2",
          price: 79.0,
          product_image: 'https://static.tildacdn.com/tild3333-6362-4031-a631-623532386533/banan_1.png'
        },
        {
          id: 3,
          title: "as3",
          price: 79.0,
          product_image: 'https://pngimg.com/uploads/potato/potato_PNG98085.png'
        },
        {
          id: 4,
          title: "as4",
          price: 79.0,
          product_image: 'https://2.bp.blogspot.com/-pjWnt7Zripk/Xubp-Nzx_iI/AAAAAAAA008/UWtEjZUH0Bosu4NCjvkjynigX1tqk4rngCK4BGAYYCw/s1600/%25D1%2585%25D0%25BB%25D0%25B5%25D0%25B1_%2BDoV%2B%25286%2529.png'
        }
      ],
      category_products: [
        {
          id: 1,
          name_category: "Молочные продукты",
        },
        {
          id: 2,
          name_category: "Фрукты и овощи",
        }
      ],
      shops: [
        {
          shop_id: 1,
          shop_name: 'Перекресток'
        },
        {
          shop_id: 2,
          shop_name: 'Ашан'
        }
      ]
    };
  },
  computed: {
    filter_products: function () {
      var search_word = this.search.toLowerCase();
      return this.products.filter(
        (x) =>
          (x.title.toLowerCase().includes(search_word)));
    },
  },
  created() {
    var vm = this;
    axios.get("http://localhost/php/get_card_products.php").then((res) => {
      vm.products = res.data.products;
      vm.category_products = res.data.category_products;
      vm.shops = res.data.shops;
    });
  },
};
</script>

<style scoped>
.v-catalog {
  margin-top: 30px;
  margin-bottom: 80px;
  display: grid;
  grid-template-columns: 0.5fr 1.5fr 0fr;
  grid-template-rows: 0.1fr 1.9fr 0fr;
  gap: 30px 15px;
  grid-template-areas:
    "category search ."
    "category items ."
    ". . .";
}
.items {
  grid-area: items;
}
.category {
  grid-area: category;
  border-right: 1px solid grey;
}
.category__products_item{
  padding: 5px;
  text-decoration: none;
}
.category__products_item:hover{
  cursor: pointer;
  color: rgb(0, 208, 42);
}
.category__shops_item{
  padding: 5px;
}
.search {
  grid-area: search;
}
.v-catalog__list {
  display: grid;
  max-width: 100%;
  grid-column-gap: 20px;
  grid-row-gap: 20px;
  grid-template-columns: repeat(auto-fill, 250px);
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: center;
}
.search__input {
  width: 60%;
  height: 2em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  background: rgba(186, 193, 187, 0.48);
  border-radius: 26.5px;
  font-size: 16px;
}
select:-webkit-autofill {
  background-color: rgb(250, 255, 189) !important;
  background-image: none !important;
  color: rgb(0, 0, 0) !important;
}
.category__checkbox{
  width: 20px;
  height: 20px;
   border-color: red;
  background-color: red;
  background:burlywood;
}
label {
  padding: 0;
}
</style>
