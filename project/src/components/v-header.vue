<template>
<div class="v-header">
    <div class="header__inner">
        <div class="header__logo-wrapper">
            <h1>Ваша Доставка</h1>
        </div>
        <div class="header__menu">
            <ul>
                <li><router-link to="/">Главная</router-link></li>
                <li><router-link to="/catalog">Каталог</router-link></li>
                <li><router-link to="/signin">Вход</router-link></li>
                <li><router-link to="/cart">Корзина</router-link></li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
export default {
   name: 'v-header',
   data(){ //это персональные данные
       return{
           title: 'card'
       }
       
       
   }

}
</script>

<style>
.v-header{
    position: sticky;
    left: 0;
    top: 0;
    width: 100%;
    min-height: 80px;
    background: #13E202;
    padding: 15px 0;
    z-index: 100;
   box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
.header__inner{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin: auto;
    padding: auto;
}
.header__menu{
    display: flex;
    flex-direction: row;
    vertical-align: middle;
}
ul {
    list-style: none;
    margin: auto;
    padding: auto;
}
a {
    text-decoration: none;
    color: black;
}
a:hover{
    color: rgb(73, 69, 69);
}
a.router-link-exact-active {
  color: #ffffff;
}
li {
    float:left; 
    margin-right:15px; /*Добавляем отступ у пунктов меню*/
}
/* ::placeholder{
  color: #fff;
} */

</style>
