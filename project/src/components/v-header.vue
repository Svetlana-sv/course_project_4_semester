<template>
  <div class="v-header">
    <div class="header__inner">
      <div class="header__logo_wrapper">Ваша Доставка</div>
      <div class="header__menu">
        <ul>
          <li><router-link to="/">Главная</router-link></li>
          <li><router-link to="/catalog">Каталог</router-link></li>
          <li><router-link to="/signin">Вход</router-link></li>
          <li><router-link to="/cart">Корзина</router-link></li>
          <li><router-link to="/admin">Админ</router-link></li>
        </ul>
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
.v-header {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  top: 0;
  width: 100%;
  min-height: 80px;
  background: #13e202;
  align-items: center;
  display: flex;
  padding: 15px 0;
  z-index: 100;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.header__logo_wrapper {
  font-size: 2.5em;
}

.header__inner {
  display: flex;
  flex-direction: row;
  width: 100%;
  justify-content: space-around;
  margin: auto;
  padding: 0;
}
.header__menu {
  display: flex;
  flex-direction: row;
  vertical-align: middle;
}
ul {
  list-style: none;
  margin: auto;
  padding: 0;
}
a {
  text-decoration: none;
  color: rgb(0, 0, 0);
  font-size: 1.5em;
}
a:hover {
  color: rgb(73, 69, 69);
  cursor: pointer;
}
a.router-link-exact-active {
  color: #ffffff;
}
li {
  float: left;
  padding-right: 10px;
  padding-left: 10px;
}
/* ::placeholder{
  color: #fff;
} */

@media screen and (max-width: 400px) {
  .header__inner {
    flex-direction: column;
    justify-content: center;
    margin: auto;
    padding: 0;
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
    padding: 0;
  }
  .header__logo_wrapper {
    margin-bottom: 0.5em;
  }
}
</style>
