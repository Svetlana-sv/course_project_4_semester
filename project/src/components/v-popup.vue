<template>
  <div class="popup_wrapper" ref="popup_wrapper">
    <div class="v-popup">
      <div class="v-popup__header">
        <p>{{ name }}</p>
      </div>
      <div class="v-popup__content">
        <slot></slot>
      </div>
      <div class="v-popup__footer">
        <button class="close_modal" @click="closePopup">Close</button>
        <button class="submit_btn">В корзину</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-popup",
  data() {
    return {
        name: String
    };
  },
};
</script>

<style scoped>
</style>
