<template>
  <div class="v-cart-item" id="v-cart-item">
    <div class="item__discription">
      <div class="v-cart-item__image">
        <img :src="product_image" alt="" />
      </div>
    <p class="v-cart-item__name" id="v-cart-item__name">{{ name }}</p>
      <p class="v-cart-item__price" id="v-cart-item__price">Цена: {{ price }} Ꝑ</p>
      <div class="v-cart-item__count">
        <!--<p class="v-cart-item__price">Кол-во:</p>-->

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
          required
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
      minCount: 0.1,
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
  padding: 5px;
  display: grid;
  
  align-items: center;
  width: 90%;
  grid-template-columns: 1fr 2fr 1fr 1fr;
}
.v-cart-item__name {
  max-width: 250px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.v-cart-item__image{
  display: flex;
  text-align: center;
  align-items: center;
  margin-left: 20px;
  width: 90px;
  height: 90px;
}

.v-cart-item__image img{
  margin: auto;
  max-width: 90px;
  max-height: 90px;
}
.v-cart-item__price {
  margin-left: 5px;
  width: auto;
  align-items: center;
  text-align: center;
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
  text-align: center;
  align-items: center;
  justify-content: center;
  margin: auto;
}

.v-cart-item__count input[type="number"] {
	background-color: #eee;
	vertical-align: top;
	outline: none;
	padding: 0;
  margin: 5px;
	height: 30px;
	line-height: 40px;    
	text-indent: 10px;
	display: inline-block;
	width: 100%;
	box-sizing: border-box;
	border: 1px solid #ddd;
	font-size: 14px;
	border-radius: 3px;
} 
 
.v-cart-item__count input[type="number"]:focus {
	outline: 2px solid rgb(43, 255, 0);
}

.v-cart-item__count input[type="number"]:invalid+span:after {
	content: '✖';
	padding-left: 5px;
	color: red;
}
.v-cart-item__count input[type="number"]:valid+span:after {
	content: '✓';
	padding-left: 5px;
	color: green;
}

.v-cart-item__button-count {
  width: 30px;
  height: 30px;
  border: 1px solid #ddd;
  border-radius: 20px;
}
.v-cart-item__input {
  width: 40px;
}
button{
  font-family: 'Dela Gothic One', cursive;
  margin: auto;
}
input{
  height: 20px;
}

@media screen and (max-width: 900px) {
  .v-cart-item {
    width: 80%;
    margin: auto;
    margin-bottom: 10px;
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
    justify-items: center;
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
  .v-cart-item__image {
    margin: 0;
  }
  .v-cart-item__button {
    padding: 0;
    margin: auto;
  }
}


</style>
