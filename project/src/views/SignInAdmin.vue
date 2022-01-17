<template>
  <div class="admin">
      <div class="signin__form">
        <form class="form" v-on:submit.prevent="onSubmit">
        <legend>Форма авторизации для администратора</legend>

        <label class="form__label">Введите логин:</label>
        <input class="form__input" type="text" v-model="login" required autofocus placeholder="Введите логин" />
        <label class="form__label">Введите пароль:</label>
        <input class="form__input" type="password" v-model="password" required placeholder="Введите пароль" />
        <button class="form__btn" type="submit" @click="SignIn">Войти</button>
      </form>
      </div>
  </div>
</template>

<script>
import axios from "axios";
import router from '../router';

export default {
  name: "signinadmin",
  data() {
    return {
      login: "",
      password: "",
      isAutorized: false,
      products: [],
      categories: [],
      shops: [],
      name: "",
      discription: "",
      selectedCategory: "",
      selectedShop: "",
      link: "",
      price: 0,
      quantity: "",
      id: -1,
      query: false,
    };
  },
  mounted: function () {
    //this.getTableData();
  },
  methods: {
    SignIn: function () {
      var params = { login: `${this.login}`, password: `${this.password}` };
      var vm = this;
      axios
        .get("http://localhost/php/signin_admin.php", {
          params,
        })
        .then(function (response) {
          vm.isAutorized = response.data.session;
          if (response.data.session) {
              router.replace("adminaccount");
          }
        });
    },
    getTableProducts() {
      let vm = this;
      axios
        .get("http://localhost/php/get_table_products.php")
        .then(function (response) {
          vm.products = response.data.products;
          vm.categories = response.data.categories;
          vm.shops = response.data.shops;
        });
    },
    onRowClick(id) {
      this.id = id;
      this.query = true;
      console.log(id);
      var w = document.getElementById("window");
      w.style.display = "block";
      var b = document.getElementById("btn_delete");
      b.style.display = "block";
      this.products_filter.forEach((element) => {
        this.name = element.product_name;
        this.discription = element.product_discription;
        this.link = element.product_image;
        this.price = element.price;
        this.quantity = element.quantity_name;
        (this.selectedCategory = element.category_id),
          (this.selectedShop = element.shop_id);
      });
    },
    SaveProduct(b) {
      let vm = this;
      if (b) {
        if (this.query === true) {
          axios
            .get(
              `http://localhost/php/save_data_products.php?
                product_id=${this.id}&
                product_name=${this.name}&
                product_discription=${this.discription}&
                shop_name=${this.selectedShop}&
                category_name=${this.selectedCategory}&
                product_image=${this.link}&
                price=${this.price}&
                quantity_name=${this.quantity}`
            )
            .then(function (response) {
              alert("Сохранено!");
               vm.getTableProducts();
            });
          var w = document.getElementById("window");
          w.style.display = "none";
          this.getTableProducts();
        } else {
          axios
            .get(
              `http://localhost/php/add_product.php?
                product_name=${this.name}&
                product_discription=${this.discription}&
                shop_name=${this.selectedShop}&
                category_name=${this.selectedCategory}&
                product_image=${this.link}&
                price=${this.price}&
                quantity_name=${this.quantity}`
            )
            .then(function (response) {
              alert("Сохранено!");
              vm.getTableProducts();
            });
          var w = document.getElementById("window");
          w.style.display = "none";
          this.getTableProducts();
        }
      } else {
        var w = document.getElementById("window");
        w.style.display = "none";
      }
    },
    AddProduct() {
      this.name = "";
      this.discription = "";
      this.selectedCategory = "";
      this.selectedShop = "";
      this.link = "";
      this.price = 0;
      this.quantity = "";
      this.query = false;
      var w = document.getElementById("window");
      w.style.display = "block";
      var b = document.getElementById("btn_delete");
      b.style.display = "none";
    },
    DeleteProduct() {
      let vm = this;
      axios
        .get(
          `http://localhost/php/delete_data_products.php?
                product_id=${this.id}`
        )
        .then(function (response) {
          alert("Удалено!");
          var w = document.getElementById("window");
          w.style.display = "none";
           vm.getTableProducts();
        });
    },
  },
  computed: {
    products_filter: function () {
      if (this.id != -1) {
        return this.products.filter((x) => x.product_id === this.id);
      }
    },
  },
  created() {
    this.getTableProducts();
  },
};
</script>

<style>

.admin {
  max-width: 100%;
  display: flex;
  justify-content: center;
  text-align: center;
  margin: auto;
  padding: 0;
  margin-top: 40px;    
    align-items: center;
    flex-direction: row;
}
.admin__panel{
  display: flex;
  flex-direction: column;
}
/* форма */

  .signin {
    max-width: 100%;
    min-height: 100%;
    text-align: center;
  }
  .signin__form {
    width: 50%;
    margin: 0px;
    padding: 0;
    padding: 10px 50px 50px 50px;
    border: rgb(10, 191, 0) solid 1px;
    border-radius: 20px;
  }
  .signin__form legend {
    padding: 15px;
    font-weight: bold;
    font-size: 1.4em;
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
    height: 40px;
    width: 180px;
    margin: auto;
    padding: 0;
    background: rgb(94, 225, 87);
    margin-bottom: 10px;
    font-size: var(--font--s--btn);
  }

  button {
    height: 35px;
    width: 175px;
    border-radius: 20px;
  }

/* стили для таблицы */
table.table-2 {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}
.td_img {
  max-width: 600px;
}
.td_price {
  min-width: 60px;
}
.td_id{
  background-color: rgb(150, 150, 150);
}
table.table-2 tr {
  background-color: #ffffff;
}
table.table-2 th,
table.table-2 td {
  text-align: left;
  padding: 8px;
  border: 1px solid rgb(28, 28, 28);
}

table.table-2 th {
  font-weight: bold;
}
table.table-2 td {
  white-space: normal;
  word-break: break-all;
  overflow: visible;
  text-overflow: clip;
  text-align: center;
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
  .td_id{
  background-color: rgb(150, 150, 150);
  border: 3px solid rgb(28, 28, 28);
}
}
.table__image {
  max-width: 120px;
  max-height: 120px;
}

#window {
  display: none;
  position: fixed;
  text-align: left;
  align-self: center;
  margin: auto;
  top: 150px;
  max-width: 600px;
  height: 510px;
  background-color: rgb(255, 255, 255);
  padding: 20px 50px;
  color: black;
  border-radius: 20px;
  border: rgb(45, 221, 1) solid 2px;
}

.form__data_products {
  text-align: center;
  display: flex;
  flex-direction: column;
  margin-bottom: 100px;
}
.data_products__item {
  display: grid;
  grid-template-columns: 0.5fr 1fr;
  text-align: left;
  margin: 5px;
}
.data_products__item input {
  width: 300px;
  height: 30px;
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  margin: auto;
}
.data_products__item select {
  width: 300px;
  height: 30px;
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  padding: 0 20px;
  margin: auto;
}
.data_products__item label {
  margin-bottom: 10px;
}
.form__data_products button {
  margin: auto;
  height: 45px;
  margin-top: 15px;
}
</style>