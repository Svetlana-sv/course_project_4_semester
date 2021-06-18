<template>
    <div class="cart">
<v-cart-item/>
    </div>
    
</template>

<script>
import vCartItem from "./v-cart-item.vue";

export default {
   name: 'v-cart',
   components:{
       vCartItem
   },
   data(){ //это персональные данные
       return{
           title: 'card'
       }
       
   },

}
</script>

<style scoped>
.cart{
    max-width: 100%;
    display: flex;
    flex-direction: column;
    margin: auto;
    padding: 15px 0;
    align-items: center;
}
</style>
