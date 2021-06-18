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
      <div class="category__products"   
        v-for="(category, index) in category_products"
        :key="index"
      >
       <p>{{category.name_category}}</p>
      </div>
      <h1>Магазин</h1>
      <div>
        <input
          class="category__checkbox"
          type="checkbox"
          id="ashan"
          v-model="checked"
        />
        <label for="ashan">Ашан</label>
      </div>
    </div>

    <div class="items">
      <div class="v-catalog__list">
        <v-catalog-item 
        :name="food.title"
        :price="food.price"
        v-for="(food, index) in food_info"
        :key="index" />
      </div>
    </div>

  </div>
</template>

<script>
import vCatalogItem from "./v-catalog-item.vue";
import vPopup from './v-popup.vue'

export default {
  name: "v-catalog",
  components: {
    vCatalogItem,
    vPopup
  },
  data() {
    //это персональные данные
    return {
      food_info: [
        {
        id: 1,
        title: 'Бананы',
        price: 79.00 
        },
        {
        id: 2,
        title: 'as2',
        price: 79.00
        },
        {
        id: 3,
        title: 'as3',
        price: 79.00
        },
        {
        id: 4,
        title: 'as4',
        price: 79.00
        }
        ],
      category_products: [
        {
          id: 1,
          name_category: 'Молочные продукты'
        },
         {
          id: 2,
          name_category: 'Фрукты и овощи'
        }
      ]
    };
  },
};
</script>

<style scoped>
.v-catalog {
  margin-top: 30px;
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
  border-right: 1px solid grey;;
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
label {
  padding: 0;
}
</style>
