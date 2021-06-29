<template>
  <div class="catalog">
   <v-catalog/>
  </div>
</template>

<script>
import vCatalog from '../components/v-catalog.vue'

export default {
  name: 'Catalog',
  components: {
      vCatalog
  }
}
</script>

<style>
#v-footer {
    display: static;
  }
</style>
