<template>
  <div class="cart">
    <h1>Корзина</h1>
   <v-cart/>
  </div>
</template>

<script>
import vCart from '../components/v-cart.vue'

export default {
  name: 'Cart',
  components: {
      vCart
  }
}
</script>

<style>

</style>