<template>
<body>

 <v-header id="v-header"/>

  
  <router-view/>
  <v-footer id="v-footer"/>
  </body>
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
:root{
    --font--s--btn: 0.9em;
    --color-primary: #f63;
    --hover-color: #ff7e53
}
html{
  height: 100%;
}
a{
  text-decoration: none;
  color: #000;
}
body{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
    min-height: 100%;
    position: relative; 
    padding-bottom: 100px;
}


#app {
  font-family: 'Open Sans', sans-serif;
  font-weight: 500;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;

}
::placeholder{
  font-family: 'Open Sans', sans-serif;
}
p{
   padding: 0;
  margin: 0;
}
button{
  font-family: 'Open Sans', sans-serif;
}

</style>
