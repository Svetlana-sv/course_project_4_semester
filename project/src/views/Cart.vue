<template>
  <div class="cart">
    <h1>Корзина</h1>
    <v-cart />
  </div>
</template>

<script>
import vCart from "../components/v-cart.vue";

export default {
  name: "Cart",
  components: {
    vCart,
  },
};
</script>

<style>


  #v-footer {
    display: none;
  }
@media print {
  #v-header,
  #v-footer {
    display: none;
  }
  body {
    background-color: white;
    page-break-inside: avoid;
    orphans: 5;
    widows: 2;
    text-align: center;
  }

  #v-cart-item {
    display: flex;
    flex-direction: row;
    align-items: center;
    min-height: 100px;
    background: #ffffff;
    border: none;
    text-align: center;
    width: 90%;
    padding: 5px;
    margin-bottom: 10px;
    box-shadow: none;
  }
  button{
    display: none;
  }
  p{
    font-size: 1em;
  }
  #v-cart-item__name {
  max-width: 200px;
  min-height: 30px;
  overflow-wrap: break-word;
  overflow: inherit;
  text-overflow: inherit;
  white-space: inherit;
}
input{
  height: 20px;
  border: none;
  font-size: 2em;
}
#v-cart-item__price{
  font-size: 1em;
}
#create_card__text{
  font-size: 2em;
}
image{
  display: none;
}
}
</style>