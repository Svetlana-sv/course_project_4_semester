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

    <div class="graph">
      <div class="progress-bar blue stripes">
        <span style="width: 40%"></span>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Main"
};
</script>

<style scoped>
/* график */
.graph {
  text-align: left;
}
.progress-bar {
  background-color: #1a1a1a;
  height: 25px;
  padding: 5px;
  width: 350px;
  margin: 50px 0;
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

/*---------------------------*/

.glow span {
  -moz-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
  -webkit-box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
  box-shadow: 0 5px 5px rgba(255, 255, 255, 0.7) inset,
    0 -5px 5px rgba(255, 255, 255, 0.7) inset;
}

/* конец */
.main {
  width: 100%;
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
  background: #13e202;
  border: 3px solid #ffffff;
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
@media screen and (max-width: 1100px) {
  .main__content {
    padding: 20px;
    text-align: center;
  }
}
</style>
