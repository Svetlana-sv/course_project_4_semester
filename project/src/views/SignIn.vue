<template>
  <div class="signin">
 
    <div v-if="isCustomer">
      <div class="form__customer">
        <h1>Личный кабинет</h1>

        <form action="" class="form__customer-data" v-on:submit.prevent="onSubmit">
          <legend>Персональные данные</legend>
          <div class="customer-data__item">
            <label for="lastname">Фамилия:</label>
            <input type="text" placeholder="Фамилия" v-model="last_name"/>
          </div>
          <div class="customer-data__item">
            <label for="">Имя:</label>
            <input type="text" placeholder="Имя" v-model="first_name"/>
          </div>
          <div class="customer-data__item">
            <label for="">Отчество:</label>
            <input type="text" placeholder="Отчество" v-model="middle_name"/>
          </div>
          <div class="customer-data__item">
            <label for="">Город:</label>
            <input type="text" placeholder="Город" v-model="city" />
          </div>
          <div class="customer-data__item">
            <label for="">Улица:</label>
            <input type="text" placeholder="Улица" v-model="street"/>
          </div>
          <div class="customer-data__item">
            <label for="">Дом:</label>
            <input type="number" placeholder="Дом" v-model="house"/>
          </div>
          <div class="customer-data__item">
            <label for="">Квартира:</label>
            <input type="number" placeholder="Квартира" v-model="flat"/>
          </div>
          <div class="customer-data__item">
            <label for="">Этаж:</label>
            <input type="number" placeholder="Этаж" v-model="floor"/>
          </div>
          <button type="submit" @click="SaveData">Сохранить</button>
        </form>
      </div>
    </div>
    <div v-else id="autorize">
      <h1>Форма авторизации</h1>
      <div class="signin__form">
        <form class="form" v-on:submit.prevent="onSubmit">
          <label class="form__label">Номер мобильного телефона:</label>
          <input
            class="form__input"
            type="text"
            v-model="login"
            required
            autofocus
            placeholder="Введите номер"
          />
          <label class="form__label">Пароль:</label>
          <input
            class="form__input"
            type="password"
            v-model="password"
            required
            placeholder="Введите пароль"
          />
          <button class="form__btn" type="submit" @click="SignIn">Войти</button>
          <p @click="ShowRegistr">Регистрация...</p>
        </form>

        
      </div>
    </div>
    <div class="signup_modal" id="modal">
          <h1>Форма регистрации</h1>
          <div class="signin__form">
            <form class="form" v-on:submit.prevent="onSubmit">
              <label class="form__label"
                >Введите номер мобильного телефона:</label
              >
              <input
                class="form__input"
                type="text"
                v-model="login1"
                required
                autofocus
                placeholder="Введите номер"
              />
              <label class="form__label">Придумайте пароль:</label>
              <input
                class="form__input"
                type="password"
                v-model="password1"
                required
                placeholder="Введите пароль"
              />
              <button class="form__btn" type="submit" @click="SignUp">
                Зарегистрироваться
              </button>
            </form>
          </div>
        </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SignIn",
  data() {
    return {
      login1: "",
      password1: "",
      login: "",
      password: "",
      isCustomer: false,
      customerData: [],
      customer_id: -1,
      last_name: '',
      first_name: '',
      middle_name: '',
      city: '',
      street: '',
      house: -1,
      flat: -1,
      floor: -1
    };
  },
  methods: {
    SignIn() {
      if (this.login == "" || this.password == "" || this.password.length!=11) {
       alert("Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX");
        return;
      }
      let vm = this;
      let params = { login: `${this.login}`, password: `${this.password}` };
      axios
        .get("http://localhost/php/signin_customer.php", {
          params
        })
        .then(function (response) {
          if (response.data.session) {
            vm.isCustomer = response.data.session;
            vm.GetData(response.data.data);
            vm.customerData = response.data.data;
            vm.$store.commit("addCustomerData", response.data.data);
            vm.$store.commit("changeStatus", vm.isCustomer);
          }
        });
    },
    SignUp: function () {
      if (this.login1 == "" || this.password1 == "" || this.password1.length!=11) {
        alert("Введите корректные данные! Формат для номера мобильного телефона : 7XXXXXXXXXX");
        return;
      }
      let params = { login: `${this.login1}`, password: `${this.password1}` };
      axios
        .get("http://localhost/php/signup_customer.php", {
          params
        })
        .then(function (response) {
           alert("Вы успешно зарегистрированы!");
        });
    },
    ShowRegistr() {
      var modal = document.getElementById("modal");
      modal.style.display = "block";
    },
    SaveData() {
      var params = { customer_id: `${this.customer_id}`, last_name: `${this.last_name}`, first_name: `${this.first_name}`, middle_name: `${this.middle_name}`,
      city: `${this.city}`,street: `${this.street}`,flat: `${this.flat}`,floor: `${this.floor}`,house: `${this.house}`};
      this.$store.commit("addCustomerData", params);
      axios
        .get("http://localhost/php/save_data_customer.php", {
          params
        })
        .then(function (response) {
          alert("Данные успешно изменены!");
        });
    },  
    GetData(data){    
      this.customer_id = data.customer_id;
      this.last_name = data.last_name;
      this.first_name = data.first_name;
      this.middle_name = data.middle_name;
      this.city = data.city;
      this.street = data.street;
      this.flat = data.flat;
      this.floor = data.floor;
      this.house = data.house; 

    }
  },
  created(){
    console.log('created');
    this.isCustomer=this.$store.getters.isCustomer; 
    if(this.isCustomer){
      this.GetData(this.$store.getters.customerData);
    }
  }
};
</script>

<style scoped>
#modal{
display: none;
}
.signup_modal {
  
  margin: auto;
  padding: 0;
  width: 100%;
  top: 110px;
  margin-bottom: 100px;
}
.signin {
  max-width: 100%;
  min-height: 100%;
  text-align: center;
}
.signin__form {
  max-width: 30%;
  margin: auto;
  margin-top: 50px;
  padding: 0;
  padding: 50px;
  border: rgb(10, 191, 0) solid 1px;
  border-radius: 20px;
}
/**/
.form__customer-data {
  text-align: center;
  margin-bottom: 100px;
}
.form__customer{
  margin-bottom: 100px;
}
.customer-data__item {
  display: flex;
  flex-direction: column;
  text-align: center;
  margin: 10px;
}
.customer-data__item input {
  background: #E9EFF6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  width: 300px;
  height: 30px;
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
  background: #E9EFF6;
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

button {
  height: 35px;
  width: 160px;
  border-radius: 20px;
  margin-bottom: 80px;
}

@media screen and (max-width: 600px) {
  .signin__form {
    margin: auto;
    padding: 0;
    min-width: 100%;
    margin-top: 20px;
  }
  .form__input {
    max-width: 200px;
    margin: auto;
    margin: 10px;
  }
  .form__label {
    padding: 10px;
  }
}

@media screen and (min-width: 1920px) {
  .signin__form {
    max-width: 678px;
  }
}
</style>

