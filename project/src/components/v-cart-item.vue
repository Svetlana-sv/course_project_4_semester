<template>
    <div class="v-cart-item">
<img class="v-cart-item__image" src="../assets/logo.png" alt="" />
    <div class="item__discription">
    <p class="v-cart-item__name">{{name}}</p>
    <p class="v-cart-item__price">{{price}}</p>
    </div>
    <button class="v-cart-item__button">Удалить</button>
    </div>
    
</template>

<script>
export default {
   name: 'v-cart-item',
   
   data(){ //это персональные данные
       return{
           title: 'v-cart-item'
       }
       
   },

}
</script>

<style scoped>
.v-cart-item {
    display: flex;
    align-items: center;
  width: 840px;
  height: 100px;
  background: #ffffff;
  box-shadow: 1px 4px 4px 2px rgba(0, 0, 0, 0.25);
  border-radius: 39px;
  padding: 10px;
  margin-bottom: 10px;
}
.item__discription{
    text-align: left;
}
.v-cart-item__image {
  width: 70px;
  height: 70px;
}
.v-cart-item__price{
  padding-left: 10px;
}
.v-cart-item__button{
  margin-top: 10px;
  width: 85px;
  height: 35px;
  border-radius: 20px;
  cursor: pointer;
  font-size: var(--font--s--btn);
}
</style>
