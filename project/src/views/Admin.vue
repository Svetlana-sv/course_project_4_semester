<template>
  <div class="admin">
    <div v-if="isAutorized" class="admin__panel">
      <div>
        <button type="submit" @click="AddProduct()">Добавить товар</button>
      </div>
      <div class="window" id="window">
        <form
          action=""
          class="form__data_products"
          v-on:submit.prevent="onSubmit"
        >
          <div class="data_products__item">
            <label for="">Название:</label>
            <input type="text" placeholder="Название" v-model="name" />
          </div>
          <div class="data_products__item">
            <label for="">Описание:</label>
            <input type="text" placeholder="Описание" v-model="discription" />
          </div>
          <div class="data_products__item">
            <label for="">Категория:</label>
            <select v-model="selectedCategory">
              <option
                :value="c.category_id"
                v-for="(c, index) in categories"
                :key="index"
              >
                {{ c.category_name }}
              </option>
            </select>
          </div>
          <div class="data_products__item">
            <label for="">Магазин:</label>
            <select v-model="selectedShop">
              <option
                :value="s.shop_id"
                v-for="(s, index) in shops"
                :key="index"
              >
                {{ s.shop_name }}
              </option>
            </select>
          </div>
          <div class="data_products__item">
            <label for="">Ссылка на картинку:</label>
            <input
              type="text"
              placeholder="Ссылка на картинку"
              v-model="link"
            />
          </div>
          <div class="data_products__item">
            <label for="">Цена:</label>
            <input type="text" placeholder="Цена" v-model="price" />
          </div>
          <div class="data_products__item">
            <label for="">Количество в:</label>
            <input type="text" placeholder="кг/шт/г" v-model="quantity" />
          </div>
          <button type="submit" @click="SaveProduct(true)">Сохранить</button>
          <button type="submit" @click="DeleteProduct()" id="btn_delete">
            Удалить продукт
          </button>
          <button type="submit" @click="SaveProduct(false)">
            Выйти без сохранения
          </button>
        </form>
      </div>
      <h1>Продукты</h1>
      <div class="table-wrap">
        <table class="table-2">
          <tr>
            <td class="td_id">product_id</td>
            <td>product_name</td>
            <td>product_discription</td>
            <td>shop_name</td>
            <td>category_name</td>
            <td>product_image</td>
            <td>price</td>
            <td>quantity_name</td>
          </tr>
          <tr
            @click="onRowClick(product.product_id)"
            v-for="(product, index) in products"
            :key="index"
          >
            <td class="td_id">{{ product.product_id }}</td>
            <td>{{ product.product_name }}</td>
            <td>{{ product.product_discription }}</td>
            <td>{{ product.shop_name }}</td>
            <td>{{ product.category_name }}</td>
            <td class="td_img">
              <img
                :src="product.product_image"
                alt=""
                class="table__image"
              /><br />{{ product.product_image }}
            </td>
            <td class="td_price">{{ product.price }}</td>
            <td>{{ product.quantity_name }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div v-else>
      <h1>Форма авторизации</h1>
      <div class="signin__form">
        <form class="form" v-on:submit.prevent="onSubmit">
          <label class="form__label">Логин:</label>
          <input
            class="form__input"
            type="text"
            v-model="login"
            required
            autofocus
            placeholder="Введите логин"
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
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "admin",
  data() {
    return {
      login: "",
      password: "",
      isAutorized: true,
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
            vm.getTableProducts();
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
      axios
        .get(
          `http://localhost/php/delete_data_products.php?
                product_id=${this.id}`
        )
        .then(function (response) {
          alert("Удалено!");
          var w = document.getElementById("window");
          w.style.display = "none";
          this.getTableProducts();
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

<style scoped>
.admin {
  max-width: 100%;
  display: flex;
  justify-content: center;
  text-align: center;
  margin: auto;
  padding: 0;
}
#v-header,
#v-footer {
  display: none;
}
.admin__panel {
  /* display: grid;
  grid-template-columns: 0.5fr 1.5fr 0fr;
  grid-auto-rows: 1vmax;
  gap: 0px 0px;
  width: 100%;
  max-height: 100%;
  grid-template-areas:
    "menu header"
    "menu main"; */
  width: 100%;
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
  margin: auto;
  padding: 0;
}
.main {
  grid-area: main;
  background-color: aqua;
  bottom: 0;
}
.menu {
  grid-area: menu;
  background-color: rgb(72, 255, 0);
  height: 100%;
  bottom: 0;
}
.header {
  grid-area: header;
  background-color: rgb(255, 0, 89);
}
/* форма */
.signin__form {
  max-width: 30%;
  margin: auto;
  margin-top: 50px;
  padding: 0;
  padding: 50px;
  border: black solid 1px;
  border-radius: 20px;
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
}
.form__btn {
  height: 35px;
  width: 160px;
  margin: auto;
  padding: 0;
  margin-bottom: 10px;
  font-size: var(--font--s--btn);
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
  margin-top: 15px;
}
button {
  margin-top: 15px;
  height: 40px;
  width: 160px;
  border-radius: 20px;
  margin-bottom: 5px;
}
</style>