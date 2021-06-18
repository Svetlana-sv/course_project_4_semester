<template>
  <div class="signin">
    <h1>Форма авторизации</h1>
   <div class="signin__form">
 <form action="php/index.php" method="post" class="form">
      <label class="form__label">Логин:</label>
      <input class="form__input" type="text" id="login" name="login" placeholder="Введите логин">
      <label class="form__label">Пароль:</label>
      <input class="form__input" type="password" id="password" name="password" placeholder="Введите пароль">
      <button class="form__btn" type="submit">Войти</button>
      <a href="#">Регистрация...</a>
    </form>
   </div>
  </div>
</template>

<script>

</script>

<style scoped>
.signin{
  max-width: 100%;
  min-height: 100%;
}
.signin__form{
  width: 20%;
  margin: auto;
  padding: 0;
  padding: 50px;
  border: black solid 1px;
  border-radius: 20px;
}
.form{
  display: flex;
  flex-direction: column;
}
.form__label{
  text-align: left;
  margin-bottom: 5px;
}
.form__input{
  height: 35px;
  margin-bottom: 20px;
}
.form__btn{
  height: 35px;
  width: 160px;
  margin: auto;
  padding: 0;
  margin-bottom: 10px;
  font-size: var(--font--s--btn);
}
</style>

