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
      <p class="category__name">Категория</p>

      <div class="category__item">
         <a class="category__item" @click="ChooseCategory(-1)">Все категории</a>
      </div>
     
      <div
        @click="ChooseCategory(category.category_id)"
        class="category__item"
        v-for="(category, index) in category_products"
        :key="index"
      >
        <a class="category__item">{{ category.category_name }}</a>
      </div>

     <p class="category__name">Магазин</p>

     <div class="category__item">
       <a class="category__item" @click="ChooseShop(-1)">Все магазины</a>
     </div>
      
      <div
      @click="ChooseShop(shop.shop_id)"
        class="category__item"
        v-for="(shop, index) in shops"
        :key="index"
      >
        <a class="category__item">{{ shop.shop_name }}</a>
      </div>
    </div>

    <div class="items">
      <div class="v-catalog__list">
        <v-catalog-item
          :name="food.product_name"
          :description="food.product_discription"
          :price="food.price"
          :quantity_name="food.quantity_name"
          :product_image="food.product_image"
          :product_info="food"
          v-for="(food, index) in search_products"
          :key="index"
        />
      </div>
    </div>
  </div>
</template>

<script>
import vCatalogItem from "./v-catalog-item.vue";
import axios from "axios";

export default {
  name: "v-catalog",
  components: {
    vCatalogItem
  },
  data() {
    //это персональные данные
    return {
      current_id_categories: -1,
      current_id_shops: -1,
      search: '',
      products: [],
      category_products: [],
      shops: []
    };
  },
  computed: {
    search_products: function () {
      if(this.current_id_categories===-1 && this.current_id_shops===-1){
        var search_word = this.search.toLowerCase();   
        return this.products.filter(
        (x) =>
          (x.product_name.toLowerCase().includes(search_word)));
      }
      if(this.current_id_categories!=-1){
        return this.products.filter(
        (x) =>
          (x.category_id===this.current_id_categories));
      }
       if(this.current_id_shops!=-1){
        return this.products.filter(
        (x) =>
          (x.shop_id===this.current_id_shops));
      }
    }
  },
  created() {
    var vm = this;
    axios.get("http://localhost/php/get_card_products.php").then((res) => {
      vm.products = res.data.products;
      vm.category_products = res.data.category_products;
      vm.shops = res.data.shops;
    });
  },
  methods:{
    ChooseCategory(category) {
      this.current_id_categories=category;

    },
    ChooseShop(shop){
      this.current_id_shops=shop;
    }
  }
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
.category__name{
  font-size: 24px;
  padding: 10px;
  font-weight: bolder;
}
.category__item{
  padding: 5px;
  text-decoration: none;
}
.category__item:hover{
   cursor: pointer;
  color: rgb(0, 208, 42);
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
  padding-left: 10px;
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
.category__checkbox {
  width: 20px;
  height: 20px;
  border-color: red;
  background-color: red;
  background: burlywood;
}
label {
  padding: 0;
}

 /*@media screen and (max-width: 600px) {
  .v-catalog {
  margin-top: 30px;
  margin-bottom: 80px;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows:1fr;
  gap: 30px 15px;
  grid-template-areas:
    "search"
    "category"
    "items"
    ".";
}
} */
@media screen and (max-width: 800px) {
  .v-catalog {
  margin-top: 30px;
  margin-bottom: 80px;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows:1fr;
  gap: 30px 15px;
  grid-template-areas:
    "search"
    "category"
    "items"
    ".";
}
.v-catalog__list { 
  justify-content: center;
  align-items: center;
  justify-items: center;
}
}
</style>
