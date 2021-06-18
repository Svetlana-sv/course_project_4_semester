<template>
  <div class="v-footer">
    <div class="footer__inner">
      <div class="footer__logo-wrapper">Ваша Доставка</div>
      <div class="footer__menu">
        <ul>
          <li><a href="#">7(999)-999-99-99</a></li>
          <li><a href="#">с 6:00 до 23:00 ежедневно</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-footer",
  data() {
    //это персональные данные
    return {
      title: "card",
    };
  },
};
</script>

<style scoped>
.v-footer {
  position: static;
  bottom: 0;
  top: 0;
  width: 100%;
  min-height: 60px;
  background: #13e202;
  padding: 15px 0;
  z-index: 100;
  -webkit-box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
}
.footer__logo-wrapper {
  font-size: 2em;
}
.footer__inner {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
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
  padding-right: 10px;
  padding-left: 10px;
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
