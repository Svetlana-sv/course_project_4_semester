<template>
<div class="form__customer">
        <h1>Личный кабинет</h1>

         <div class="exit_btn">
          <button @click="Exit()">Выйти</button>
        </div>

        <form action="" class="form__customer-data" v-on:submit.prevent="onSubmit">
          <legend>Персональные данные</legend>
          <div class="customer-data__item">
            <label for="lastname">Фамилия:</label>
            <input type="text" placeholder="Фамилия" v-model="last_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Имя:</label>
            <input type="text" placeholder="Имя" v-model="first_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Отчество:</label>
            <input type="text" placeholder="Отчество" v-model="middle_name" />
          </div>
          <div class="customer-data__item">
            <label for="">Организация (магазин):</label>
            <select v-model="shop">
                            <option :value="s.shop_id" v-for="(s, index) in shops" :key="index">
                                {{ s.shop_name }}
                            </option>
                        </select>
            <!-- <input type="text" placeholder="Магазин" v-model="shop" /> -->
          </div>
          <div class="customer-data__item">
            <label for="">Ваш текущий статус:</label>
            <input class="item__readonly" type="text" readonly="readonly" v-model="confirmed" />
          </div>
          <button type="submit" @click="SaveData">Обновить</button>
        </form>
      </div>
</template>

<script>
 import axios from "axios";
 import router from '../router';

  export default {
    name: "SignIn",
    data() {
      return {
        isManager: false,
        managerData: [],
        shops: [],
        manager_id: -1,
        last_name: "",
        first_name: "",
        middle_name: "",
        confirmed: ""
      };
    },
    methods: {
         Exit(){
         this.$store.commit("ChangeStatusManager", false);
        router.replace("signin");
      },
      SaveData() {
        var params = {
          manager_id: `${this.manager_id}`,
          last_name: `${this.last_name}`,
          first_name: `${this.first_name}`,
          middle_name: `${this.middle_name}`,
          shop: `${this.shop}`
        };
        //this.$store.commit("addCustomerData", params);
        axios
          .get("http://localhost/php/save_data_manager.php", {// НУЖНО СОЗДАТЬ PHP
            params,
          })
          .then(function (response) {
            alert("Данные отправлены на подтверждение!");
          });
      },
      GetData(data1) {
          let vm = this;
        this.manager_id = data1.manager_id;
        this.last_name = data1.last_name;
        this.first_name = data1.first_name;
        this.middle_name = data1.middle_name;
        this.shop = data1.shop_id;
        if(data1.confirmed==1){
            this.confirmed = "Подтвержден";
        }else{
            this.confirmed = "Не подтвержден";
        }
        axios
          .get("http://localhost/php/get_shops.php", {
          })
          .then(function (response) {
            vm.shops= response.data.shops;
            console.log(response.data.shops);
          });
      },
    },
    created() {
       this.isManager = this.$store.getters.isManager;
       this.GetData(this.$store.getters.managerData);
    },
}
</script>

<style>
  .form__customer-data {
    text-align: center;
  }

  .form__customer {
    margin: auto;
    text-align: center;
    margin-bottom: 10px;
  }

  .customer-data__item {
    display: flex;
    flex-direction: column;
    text-align: center;
    margin: 10px;
  }

   .customer-data__item input {
        background: #e9eff6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    padding: 0 20px;
    width: 70%;
    height: 30px;
    margin: auto;
    }

    .customer-data__item select {
        width: 70%;
        height: 30px;
        background: #e9eff6;
        line-height: 40px;
        border-width: 0;
        border-radius: 20px;
        padding: 0 20px;
        margin: auto;
    }

  .customer-data__item label {
    margin-bottom: 10px;
  }

  .form {
    display: flex;
    flex-direction: column;
  }

  .form__label {
    text-align: left;
    margin-bottom: 5px;
  }

  .form__input {
    height: 35px;
    margin-bottom: 20px;
    background: #e9eff6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    padding: 0 20px;
  }

  .form__btn {
    height: 35px;
    width: 160px;
    margin: auto;
    padding: 0;
    background: rgb(94, 225, 87);
    margin-bottom: 10px;
    font-size: var(--font--s--btn);
  }

 

  @media screen and (max-width: 600px) {
    .form__input {
      max-width: 100%;
      margin: auto;
      margin: 10px;
    }

    .form__label {
      padding: 10px;
    }

    .form {
      padding: 10px;
    }
  }

  /* стили для таблицы */
  table.table-2 {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
  }

  table.table-2 tr {
    background-color: #f8f8f8;
  }

  table.table-2 th,
  table.table-2 td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
  }

  table.table-2 th {
    font-weight: bold;
  }

  @media screen and (max-width: 600px) {
    table.table-2 tr {
      display: block;
    }

    table.table-2 tr {
      margin-bottom: 30px;
    }

    table.table-2 th,
    table.table-2 td {
      display: block;
      text-align: center;
    }
  }
</style>