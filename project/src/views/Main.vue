<template>
  <div class="main">
    <div class="main__content">
      <div class="content__text">Ваша доставка - Ваша Еда Выбирай с умом</div>
      <button class="main__button"><router-link to="/catalog">Заказать</router-link></button>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src


export default {
  name: "Main"
};
</script>

<style scoped>
.main {
  background-image: url("../assets/image/background_img.png");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100%;
  height: 500px;
}
.main__content {
  max-width: 1000px;
  margin: auto;
  padding-top: 100px;
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
  font-size: 2em;
  color: #fff;
  width: 250px;
  height: 60px;
  margin-top: 50px;
  
}
.main__button a{
  color: #fff;
}
.main__button:hover {
  background-color: #47aa3e;
}

@media screen and (max-width: 400px) {
  .main__content{
    padding: 5px;
  }
  .content__text{
    font-size: 30px;
  }
}
@media screen and (max-width: 700px) {
  .main__content{
    padding: 10px;
  }
  .content__text{
    font-size: 45px;
    text-align: center !important;
  }
  .main__button{
    margin-top: 10px;
  }
  .main{
    height: 100%;
  }

}
@media screen and (max-width: 1100px) {
.main__content{
  padding: 20px;
  text-align: center;
}
}
</style>
