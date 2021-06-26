<template>
  <div class="main">
    <div class="main__container">
      <div class="main__content">
        <div class="content__text">Ваша доставка - Ваша Еда Выбирай с умом</div>
        <button class="main__button">
          <router-link to="/catalog">Заказать</router-link>
        </button>
      </div>
    </div>
    <div class="main__block-data">
      <p>
        Ваша Доставка - это товары и гипермаркеты по всей России<br />Мы растем,
        развиваемся. Будь с нами!
      </p>
      <div class="graph">
        <div class="progress-bar blue stripes">
          <span style="width: 40%"></span>
        </div>
        <div class="progress-bar blue stripes">
          <span style="width: 60%"></span>
        </div>
      </div>
    </div>

    <div class="main__block_promo">
      <p>Вы заказываете - мы покупаем и доставляем!</p>
      <div class="block_promo__container">
        <div class="container__item">
          <img src="../assets/image/item1.png" alt="" />
        </div>
        <div class="container__item">
          <img src="../assets/image/item2.png" alt="" />
        </div>

        <div class="container__item">
          <img src="../assets/image/item3.png" alt="" />
        </div>
        <div class="container__item">
          <img src="../assets/image/item4.png" alt="" />
        </div>
      </div>
      <button class="block_promo__button">
        <router-link to="/catalog">Заказать</router-link>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Main",
};
</script>

<style scoped>
p {
  font-family: SeoulNamsan CM;
  font-style: normal;
  font-weight: normal;
  font-size: 36px;
  line-height: 36px;
  margin-bottom: 20px;
}
.main {
  width: 100%;
}
.main__block-data {
  max-width: 100%;
  display: flex;
  flex-direction: column;
  margin: auto;
  padding: 100px 0;
  text-align: center;
}

.main__block_promo {
  max-width: 100%;
  display: flex;
  flex-direction: column;

  margin: auto;
  padding: 10px 0;
  text-align: center;
  margin-bottom: 150px;
  background-color: rgba(181, 255, 155, 0.53);
}
.block_promo__container {
  margin-top: 50px;
  display: flex;
  flex-direction: row;
  gap: 50px;
  justify-content: center;
}
.container__item {
  width: 160px;
  height: 160px;
  filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
}
.block_promo__button {
 border-radius: 30px;
  background: #13e202;
  outline: none;
  font-size: 2em;
  color: #fff;
  width: 200px;
  height: 50px;
  margin: auto;
  margin-top: 50px;
  margin-bottom: 50px;
}
.block_promo__button a {
  color: #fff;
}
.block_promo__button:hover {
  background-color: #47aa3e;
}

.main__container {
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
  border-radius: 30px;
  background: #13e202;
  outline: none;
  font-size: 2em;
  color: #fff;
  width: 250px;
  height: 60px;
  margin-top: 50px;
}
.main__button a {
  color: #fff;
}
.main__button:hover {
  background-color: #47aa3e;
}

@media screen and (max-width: 400px) {
  .main__content {
    padding: 5px;
  }
  .content__text {
    font-size: 30px;
  }
}
@media screen and (max-width: 700px) {
  .main__content {
    padding: 10px;
  }
  .content__text {
    font-size: 45px;
    text-align: center !important;
  }
  .main__button {
    margin-top: 10px;
  }
  .main__container {
    height: 100%;
  }
}
@media screen and (max-width: 900px) {
.block_promo__container {
  margin: auto;
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;

  text-align: center;
  justify-content: center;
}
.container__item {
  width: 160px;
  height: 160px;
  filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
}
.block_promo__button {
  background: #13e202;
  border: 3px solid #ffffff;
  outline: none;
  font-size: 2em;
  color: #fff;
  width: 200px;
  height: 50px;
  margin: auto;
  margin-top: 50px;
  margin-bottom: 50px;
}
}

@media screen and (max-width: 1100px) {
  .main__content {
    padding: 20px;
    text-align: center;
  }
}

/*---------- график ----------*/
.graph {
  text-align: left;
  max-width: 100%;
  margin: auto;
  margin-top: 50px;
}
.progress-bar {
  background-color: #b6ffb9;
  height: 25px;
  padding: 5px;
  width: 350px;
  margin: 0;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0 1px 5px #000 inset, 0 1px 0 #444;
  -webkit-box-shadow: 0 1px 5px #000 inset, 0 1px 0 #444;
  box-shadow: 0 1px 5px #000 inset, 0 1px 0 #444;
}

.progress-bar span {
  display: inline-block;
  height: 100%;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
  -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
  -webkit-transition: width 0.4s ease-in-out;
  -moz-transition: width 0.4s ease-in-out;
  -ms-transition: width 0.4s ease-in-out;
  -o-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
.blue span {
  background-color: #11e623;
}

.stripes span {
  -webkit-background-size: 30px 30px;
  -moz-background-size: 30px 30px;
  background-size: 30px 30px;
  background-image: -webkit-gradient(
    linear,
    left top,
    right bottom,
    color-stop(0.25, rgba(255, 255, 255, 0.15)),
    color-stop(0.25, transparent),
    color-stop(0.5, transparent),
    color-stop(0.5, rgba(255, 255, 255, 0.15)),
    color-stop(0.75, rgba(255, 255, 255, 0.15)),
    color-stop(0.75, transparent),
    to(transparent)
  );
  background-image: -webkit-linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.15) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.15) 50%,
    rgba(255, 255, 255, 0.15) 75%,
    transparent 75%,
    transparent
  );
  background-image: -moz-linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.15) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.15) 50%,
    rgba(255, 255, 255, 0.15) 75%,
    transparent 75%,
    transparent
  );
  background-image: -ms-linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.15) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.15) 50%,
    rgba(255, 255, 255, 0.15) 75%,
    transparent 75%,
    transparent
  );
  background-image: -o-linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.15) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.15) 50%,
    rgba(255, 255, 255, 0.15) 75%,
    transparent 75%,
    transparent
  );
  background-image: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.15) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.15) 50%,
    rgba(255, 255, 255, 0.15) 75%,
    transparent 75%,
    transparent
  );
}

.shine span {
  position: relative;
}

.shine span::after {
  content: "";
  opacity: 0;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: #fff;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
}
.glow span {
  -moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
  -webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
  box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
}

/*---------------------------*/

</style>
