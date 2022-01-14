<template>
  <div class="v-header">
    <div class="header__inner">
      <div class="header__logo_wrapper">
        <img src="../assets/image/logo8.png" alt="Ваша Доставка">
      </div>
      <div class="header__menu">
        <ul>
          <li>
            <router-link to="/">Главная</router-link>
          </li>
          <li>
            <router-link to="/catalog">Каталог</router-link>
          </li>
          <li>
            <router-link to="/cart">Корзина</router-link>
          </li>
        </ul>
      </div>
      <div class="header__menu_but">
        <router-link to="/signin"><img src="../assets/image/лк.png" alt="">
        Личный кабинет</router-link>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "v-header",
    data() {
      //это персональные данные
      return {
        title: "card",
      };
    },
  };
</script>

<style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap');

  .v-header {
    position: -webkit-sticky;
    position: sticky;
    left: 0;
    top: 0;
    width: 100%;
    min-height: 60px;
    background: #13e202;
    align-items: center;
    display: flex;
    margin: auto;
    padding: 5px 0;
    z-index: 100;
    font-family: 'Dela Gothic One', cursive;
    border-bottom: 1px solid rgba(106, 101, 101, 0.415);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  }

  .header__logo_wrapper {
    color: rgb(41, 41, 41);
    padding: 0px;
    margin: 0px;
  }
  .header__logo_wrapper img{
    width: 180px;
    height: auto;
    align-items: center;
    justify-content: center;
    display: flex;
    padding: 0px;
  }

  .header__inner {
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: space-around;
    margin: auto;
    padding: 0px;
  }

  .header__menu {
    display: flex;
    flex-direction: row;
    vertical-align: middle;
  }

  .header__menu_but{
     display: flex;
     flex-direction: row;   
  }
 .header__menu_but a{
    display: flex;
    flex-direction: row;
    color: rgb(255, 255, 255);
    font-size: 1em;
    align-items: center;

    justify-content: center;
  }
   .header__menu_but img{
      width: auto;
      height: 25px;
      padding-right: 10px;
  }

  ul {
    list-style: none;
    margin: auto;
    padding: 0px;
  }

  .header__menu a {
    text-decoration: none;
    color: rgb(255, 255, 255);
    font-size: 1.2em;
  }

  .header__menu a:hover {
    color: rgb(73, 69, 69);
    cursor: pointer;

  }

  .header__menu a.router-link-exact-active {
    color: #444444;
  }

  li {
    float: left;
    padding-right: 10px;
    padding-left: 10px;
    font-family: 'Dela Gothic One', cursive;
  }

  /* ::placeholder{
  color: #fff;
} */
  button {
    font-family: 'Dela Gothic One', cursive;
  }

  @media screen and (max-width: 400px) {
    .header__inner {
      flex-direction: column;
      justify-content: center;
      margin: auto;
      padding: 0px;
    }

    .header__menu {
      flex-direction: column;
      vertical-align: middle;
    }
  
    li {
      float: none;
      margin-top: 0.5em;
    }

    ul {
      margin: 0;
    }
  }

  @media screen and (max-width: 700px) {
    .header__inner {
      flex-direction: column;
      justify-content: center;
      margin: auto;
      padding: 0px;
    }
.header__menu_but{
    flex-direction: column;
    justify-content: center;
      vertical-align: middle;
  }
  .header__menu{
     margin-bottom: 0.5em;
  }
    .header__logo_wrapper{
      display: flex;
      margin-bottom: 0.5em;
      justify-content: center;
      vertical-align: middle;
    }
  }
</style>