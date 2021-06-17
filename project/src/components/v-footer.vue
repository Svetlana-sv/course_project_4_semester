<template>
<div class="v-footer">
    <div class="footer__inner">
        <div class="footer__logo-wrapper">
            <h1>Ваша Доставка</h1>
        </div>
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
   name: 'v-footer',
   data(){ //это персональные данные
       return{
           title: 'card'
       }
       
       
   }

}
</script>

<style>
.v-footer{
    position: static;
    bottom: 0;
    top: 0;
    width: 100%;
    min-height: 60px;
    background: #13E202;
    padding: 15px 0;
    z-index: 100;
    -webkit-box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15); 
}
.footer__logo-wrapper{
    widows: 10%;
}
.footer__inner{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}
.footer__menu{
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
li {
    float:left; 
    margin-right:15px; /*Добавляем отступ у пунктов меню*/
}

</style>
