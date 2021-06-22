<template>
  <div class="v-catalog-item">
    <div class="v-catalog-item__container_image">
      <img class="v-catalog-item__image" :src="product_image" alt="" />
    </div>

    <div class="item__discription">
      <div class="v-catalog-item__name">{{ name }}</div>
      <div class="v-catalog-item__name-hint">
        <p>Наименование: {{ name }}</p> 
        <p>Описание: {{ description }}</p> 
        </div>
      <p class="v-catalog-item__price">{{ price }}</p>
    </div>
    <button class="v-catalog-item__button" @click="AddToCart">Добавить</button>
  </div>
</template>

<script>
export default {
  name: "v-catalog-item",
  data() {
    return {};
  },
  props: {
    name: String,
    description: String,
    price: Float32Array,
    product_image: String,
    product_info: Array
  },
  methods:{
    AddToCart(){
      this.$store.commit("addItem", this.product_info)
    }
  }
};
</script>

<style scoped>
p {
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
.v-catalog-item__name {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.v-catalog-item__name:hover{
  cursor: pointer;
}
.v-catalog-item__name-hint {
  display: none;
  overflow-wrap: break-word;
  max-width: 240px;
  box-shadow: 1px 4px 4px 2px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  background-color: #f2f0f0;
}
.v-catalog-item__name:hover + .v-catalog-item__name-hint {
  cursor: pointer;
  display: block;
  position: absolute;
  color: #151516;
  font-size: 20px;
  overflow: inherit;
  text-overflow: inherit;
  white-space: inherit;
}
.item__discription {
  text-align: left;
}
.v-catalog-item__container_image {
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  justify-self: center;
  width: 200px;
  height: 200px;
  margin-bottom: 10px;
}
.v-catalog-item__image {
  max-width: 200px;
  max-height: 200px;
}
.v-catalog-item__price {
  padding-top: 10px;
}
.v-catalog-item__button {
  margin-top: 10px;
  width: 85px;
  height: 35px;
  border-radius: 20px;
  cursor: pointer;
  font-size: var(--font--s--btn);
}
</style>
