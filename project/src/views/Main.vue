<template>
  <div class="main">
    <div class="main__content">
      <div class="content__text">Ваша доставка - Ваша Еда Выбирай с умом</div>
      <button class="main__button">Заказать</button>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src


export default {
  name: "Main"
};
</script>

<style>
.main {
  background-image: url("../assets/image/background_img.png");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100%;
  height: 500px;
}
.main__content {
  width: 1000px;
  padding-top: 50px;
  padding-left: 150px;
  text-align: left;
}
.content__text {
  text-transform: uppercase;
  font-size: 64px;
  color: #fff;
  text-align: center;
  font-family: SeoulNamsan CM;
}
.main__button {
  background: #13e202;
  border: 3px solid #ffffff;
  outline: none;
  font-size: 32px;
  color: #fff;
  width: 250px;
  height: 60px;
  margin-top: 50px;
  font-family: SeoulNamsan CM;
}
.main__button:hover {
  background-color: #47aa3e;
}
</style>
