<template>
  <div class="v-footer">
    <div class="footer__inner">
       <div class="footer__logo-wrapper"><img src="../assets/image/logo3.png" alt=""></div>
      <div class="footer__menu">
        <ul>
          <li><a href="#">7(999)-999-99-99</a></li>
          <li><a href="#">с 6:00 до 23:00 ежедневно</a></li>
        </ul>
      </div>
    </div>
    <div class="footer__link">
© 2022 ООО Ваша Доставка
    </div>
  </div>
</template>

<script>
export default {
  name: "v-footer"
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
.v-footer {
  display: flex;
  flex-direction: column;
  position: -webkit-fixed;
  position: static;
  left: 0;
  bottom: 0;
  width: 100%;
  min-height: 60px;
  background: #ababab;
  padding: 15px 0;
  z-index: 100;
  border-top: rgb(158, 158, 158) 1px solid;
}
.footer__logo-wrapper {
  display: flex;
  align-items: center; 
  color: black;
  justify-content: center;
}

.footer__logo-wrapper img {
 width: 180px;
    height: auto;
    align-items: center;
    justify-content: center;
    display: flex;
    padding: 0px;
}

.footer__inner {
  display: flex;
  flex-direction: row;
  justify-content:space-evenly;
}
.footer__menu {
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
  color: black;
  padding: 0;
}
a:hover {
  color: rgb(73, 69, 69);
}
li {
  float: left;
  font-size: 1em;
  padding-right: 10px;
  padding-left: 10px;
  color: black;
  font-family: 'Dosis', sans-serif;
}
.footer__link{
  margin-top: 20px;
  color: rgb(255, 255, 255);
  font-family: sans-serif;
}
@media screen and (max-width: 400px) {
  .footer__inner {
    flex-direction: column;
    justify-content: center;
    margin: auto;
    padding: 0;
  }
  .footer__menu {
    flex-direction: column;
    vertical-align: middle;
  }

  ul {
    margin: 0;
  }
}
@media screen and (max-width: 700px) {
  .footer__inner {
    flex-direction: column;
    justify-content: center;
    margin: auto;
    padding: 0;
  }
  .footer__logo_wrapper {
    margin-bottom: 0.5em;
  }
  li {
    float: none;
    margin-top: 0.5em;
  }
}
</style>
