<template>
  <div class="v-catalog-item">
    <img class="v-catalog-item__image" src="../assets/logo.png" alt="" />
    <div class="item__discription">
    <p class="v-catalog-item__name">{{name}}</p>
    <p class="v-catalog-item__price">{{price}}</p>
    </div>
    <button class="v-catalog-item__button">Добавить</button>
  </div>
</template>

<script>


export default {
  name: "v-catalog-item",
  data() {
    return{
      
    }
  },
  props: {
      name: String,
      price: Float32Array
  }
}
</script>

<style>
p{
  padding: 0;
  margin: 0;
}
.v-catalog-item {
  width: 240px;
  height: 310px;
  background: #ffffff;
  box-shadow: 1px 4px 4px 2px rgba(0, 0, 0, 0.25);
  border-radius: 39px;
  padding: 10px;
  margin-bottom: 10px;
}
.item__discription{
    text-align: left;
}
.v-catalog-item__image {
  width: 200px;
}
.v-catalog-item__price{
  padding-top: 10px;
}
.v-catalog-item__button{
  margin-top: 10px;
  width: 85px;
  height: 35px;
  border-radius: 20px;
}
</style>
