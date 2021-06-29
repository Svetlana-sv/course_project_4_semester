<template>
  <div class="v-cart-item" id="v-cart-item">
    <img class="v-cart-item__image" :src="product_image" alt="" />
    <div class="item__discription">
      <p class="v-cart-item__name" id="v-cart-item__name">{{ name }}</p>
      <p class="v-cart-item__price" id="v-cart-item__price">Цена: {{ price }} Ꝑ</p>
      <div class="v-cart-item__count">
        <p class="v-cart-item__price">Кол-во:</p>

        <button
          class="v-cart-item__button-count"
          type="button"
          @click="decreaseCount"
        >
          -
        </button>
        <input
          class="v-cart-item__input"
          type="number"
          v-model="count"
          :min="minCount"
          @change="changeCount"
        />
        <button
          class="v-cart-item__button-count"
          type="button"
          @click="increaseCount"
        >
          +
        </button>
        <p class="v-cart-item__price">{{ quantity_name }}</p>
      </div>
    </div>
    <button class="v-cart-item__button" @click="Delete">Удалить</button>
  </div>
</template>

<script>
export default {
  name: "v-cart-item",

  data() {
    //это персональные данные
    return {
      count: 1,
      minCount: 0,
      products: [],
    };
  },
  props: {
    product_id: Number,
    name: String,
    price: Number,
    product_image: String,
    quantity_name: String,
  },
  methods: {
    increaseCount() {
      this.count++;
      //this.changeCount();
    },
    decreaseCount() {
      if (this.count > this.minCount) {
        this.count--;
      }
     // this.changeCount();
    },
    Delete() {
      this.$emit('deleteCard',this.product_id)
    },
    changeCount(){
      console.log('changeCount',this.count);
      this.products = this.$store.getters.cart_cards;
      //this.$emit('inc',this.product_id,this.count)
    }
  },
  watch: {
    count(count) {
        this.$emit('inc',this.product_id,this.count)
        // or generate/simulate a native events (not sure how, but its outside Vue's realm I think
    }
}
};
</script>

<style scoped>
.v-cart{
  display: flex;
  justify-content: center;
  text-align: center;
  margin: auto;
}
.v-cart-item {
  display: flex;
  flex-direction: row;
  align-items: center;
  width: 840px;
  min-height: 100px;
  background: #ffffff;
  box-shadow: 1px 4px 4px 2px rgba(0, 0, 0, 0.25);
  border-radius: 39px;
  padding: 10px;
  margin-bottom: 10px;
}
.item__discription {
  text-align: left;
  padding: 20px;
  display: grid;
  width: 90%;
  grid-template-columns: 2fr 1fr 1.5fr;
}
.v-cart-item__name {
  max-width: 250px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.v-cart-item__image {
  margin-left: 20px;
  width: 70px;
  height: 70px;
}
.v-cart-item__price {
  padding-left: 10px;
  min-width: 60px;
}
.v-cart-item__button {
  padding: 0;
  margin: auto;

  width: 85px;
  height: 35px;
  border-radius: 20px;
  margin-right: 10px;
  cursor: pointer;
  font-size: var(--font--s--btn);
}
.v-cart-item__count {
  display: flex;
  flex-direction: row;
}
.v-cart-item__button-count {
  width: 30px;
  border-radius: 20px;
}
.v-cart-item__input {
  width: 40px;
}

@media screen and (max-width: 900px) {
  .v-cart-item {
    width: 80%;
    margin: auto;
  }
  .v-cart-item__count{
    text-align: center;
    justify-content: center;
  }
}
@media screen and (max-width: 700px) {
  
  .v-cart-item {
    flex-direction: column;
    text-align: center;
    margin: auto;
    margin-bottom: 10px;
   
  }
  .item__discription {
    text-align: center;
    grid-template-columns: 1fr;
    gap: 20px;
  }
  .v-cart-item__name {
    max-width: 90%;
    white-space: normal;
    word-break: break-all;
    overflow: visible;
    text-overflow: clip;
  }
  .v-cart-item__price {
  padding: 0;
  width: 80%;
}
  .v-cart-item__image {
    margin: 0;
  }
  .v-cart-item__button {
    padding: 0;
    margin: auto;
  }
}

</style>
