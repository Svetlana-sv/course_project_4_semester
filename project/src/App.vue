<template>
  <div class="wrapper">
      <v-header id="v-header"/>
      <main class="main">
          <router-view/>
      </main>
      <v-footer id="v-footer"/>
  </div>
  
</template>

<script>
import vHeader from '@/components/v-header.vue'
import vFooter from '@/components/v-footer.vue'

export default {
  name: "app",
  components: {
    vHeader,
    vFooter
  },
  data(){
    return{
      template: `
          <h1>vffvdfd</h1>
        `
    }
  },
  methods: {
    test: function () {
      //var login = document.getElementById("admin_login").value;
      //let password = document.getElementById("admin_password").value;
      //let params = { login: `${login}`, password: `${password}` };
      
      // axios
      //   .get("http://localhost/php/index.php")
      //   .then(function (response) {
      //     document.getElementById("btn") = response.data;
      //   });
    },
  } 
};
</script>

<style>
*{
  box-sizing: border-box;
  padding: 0;
  margin: 0;
  border: 0;
}
html,body{
  line-height: 1;
  height: 100% !important;
  font-family: 'Open Sans', sans-serif;
  width: 100%;
}

.wrapper{
  min-height: 100%;
  display: flex;
  flex-direction: column;
}

.main{
  flex: 1 1 auto;
  
}

#app {
  font-family: 'Open Sans', sans-serif;
  font-weight: 500;
  height: 100%;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;

}
::placeholder{
  font-family: 'Open Sans', sans-serif;
}

button{
  font-family: 'Open Sans', sans-serif;
}

a{
  text-decoration: none;
  color: #000;
}

</style>
