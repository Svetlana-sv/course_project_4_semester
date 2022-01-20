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
        <select v-model="shop_id">
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
      <button type="submit" @click="SaveData()">Обновить</button>
    </form>

    <div v-if="confirmed == 1">
      <div>
        <p v-for="(p, index) in popular_product" :key="index">Самый популярный товар: {{p.product_name}} - {{p.c}} заказов - {{p.sum}}₽</p>
      </div>

      

      <div class="admin__menu">
        <ul>
          <li>
            <button @click="changePage('orders')">Таблица заказов</button>
          </li>
          <li>
            <button @click="changePage('products')">Все продукты</button>
          </li>
          <!-- <li>
                    <button @click="changePage('products')">Все продукты</button>
                </li> -->
        </ul>
      </div>
   
      <div v-if="page=='orders'">
        <h1>Таблица заказов</h1>
        
        <div class="table-wrap">
          <table class="table-2">
            <tr>
              <td class="td_id">Номер заказа</td>
              <td>Дата заказа</td>
              <td>Название</td>
              <td>Количесво</td>
              <td>Цена</td>
              <td>Общая сумма</td>
            </tr>
            <tr v-for="(order, index) in orders" :key="index">
              <td class="td_id">{{ order.order_id }}</td>
              <td>{{ order.order_data }}</td>
              <td>{{ order.product_name }}</td>
              <td>{{ order.sum }}</td>
              <td>{{ order.price }}</td>
              <td>{{ order.itog }}</td>
            </tr>
          </table>
        </div>
      </div>

      <div v-if="page=='products'" class="block__products">
        <h1>Общая таблица всех продуктов</h1>
              
        <div class="products__button">
          <button type="submit" @click="AddProduct()">Добавить товар</button>
        </div>

        <div class="table-wrap">
          <table class="table-2">
            <tr>
              <!-- <td class="td_id">product_id</td> -->
              <td>Название</td>
              <td>Описание</td>
              <td>Категория</td>
              <td>Ссылка</td>
              <td>Цена</td>
              <td>Цена за</td>
              <td>Количество</td>
            </tr>
            <tr @click="onRowClick(product.product_id)" v-for="(product, index) in products" :key="index">
              <!-- <td class="td_id">{{ product.product_id }}</td> -->
              <td>{{ product.product_name }}</td>
              <td class="id_description">{{ product.product_discription }}</td>
              <td>{{ product.category_name }}</td>
              <td class="td_img">
                <img :src="product.product_image" alt="" class="table__image" /><br />{{ product.product_image }}
              </td>
              <td class="td_price">{{ product.price }}</td>
              <td>{{ product.quantity_name }}</td>
              <td>{{ product.amount }}</td>
            </tr>
          </table>
        </div>

        <!-- Всплывающее окно -->
        <div class="block__window">
        <div class="window" id="window">
            <form action="" class="form__data_products" v-on:submit.prevent="onSubmit">
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
                        <option :value="c.category_id" v-for="(c, index) in categories" :key="index">
                            {{ c.category_name }}
                        </option>
                    </select>
                </div>
                <div class="data_products__item">
                    <label for="">Ссылка на картинку:</label>
                    <input type="text" placeholder="Ссылка на картинку" v-model="link" />
                </div>
                <div class="data_products__item">
                    <label for="">Цена:</label>
                    <input type="text" placeholder="Цена" v-model="price" />
                </div>
                <div class="data_products__item">
                    <label for="">Количество в:</label>
                    <input type="text" placeholder="кг/шт/г" v-model="quantity" />
                </div>
                <div class="data_products__item">
                    <label for="">Доступное количество:</label>
                    <input type="text" placeholder="Доступное количество" v-model="amount" />
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
        </div>
      </div>

        
    </div>
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
        products: [],
        categories: [],
        orders: [],
        popular_product: [],
        manager_id: -1,
        last_name: "",
        first_name: "",
        middle_name: "",
        shop_id: -1,
        confirmed: -1,
        page: "orders",
        // для таблицы продукты
        name: "",
        discription: "",
        selectedCategory: "",
        selectedShop: "",
        product_id: "",
        link: "",
        price: 0,
        amount: 0,
        quantity_name: "",
        product_id: -1,
        query: false,

      };
    },
    methods: {
      Exit() {
        this.$store.commit("ChangeStatusManager", false);
        router.replace("signin");
      },
      changePage(page) {
        this.page = page;
      },
      onRowClick(id) {
        this.product_id = id;
        console.log(this.product_id);
        this.query = true;
        var w = document.getElementById("window");
        w.style.display = "block";
        var b = document.getElementById("btn_delete");
        b.style.display = "block";
        console.log(this.products);
        this.products_filter.forEach((element) => {
          console.log(element);
            this.name = element.product_name;
            this.discription = element.product_discription;
            this.link = element.product_image;
            this.price = element.price;
            this.quantity = element.quantity_name;
            this.amount = element.amount;
            (this.selectedCategory = element.category_id)
                });
            },
            SaveProduct(b) {
                let vm = this;
                if (b) {
                    if (this.query === true) {
                        axios
                            .get(
                                `http://localhost/php/save_data_products_manager.php?
                product_id=${this.product_id}&
                product_name=${this.name}&
                product_discription=${this.discription}&
                shop_name=${this.shop_id}&
                category_name=${this.selectedCategory}&
                product_image=${this.link}&
                price=${this.price}&
                amount=${this.amount}&
                quantity_name=${this.quantity}`
                            )
                            .then(function (response) {
                                alert("Сохранено!");
                                vm.GetProducts();
                            });
                        var w = document.getElementById("window");
                        w.style.display = "none";
                        this.GetProducts();
                    } else {
                        axios
                            .get(
                                `http://localhost/php/add_product_manager.php?
                product_name=${this.name}&
                product_discription=${this.discription}&
                shop_name=${this.shop_id}&
                category_name=${this.selectedCategory}&
                product_image=${this.link}&
                price=${this.price}&
                amount=${this.amount}&
                quantity_name=${this.quantity}`
                            )
                            .then(function (response) {
                                alert("Сохранено!");
                                vm.GetProducts();
                            });
                        var w = document.getElementById("window");
                        w.style.display = "none";
                        this.GetProducts();
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
                product_id=${this.product_id}`
                    )
                    .then(function (response) {
                        alert("Удалено!");
                        var w = document.getElementById("window");
                        w.style.display = "none";
                        vm.GetProducts();
                    });
            },
      SaveData() {
        this.confirmed = 0;

        var params = {
          manager_id: `${this.manager_id}`,
          last_name: `${this.last_name}`,
          first_name: `${this.first_name}`,
          middle_name: `${this.middle_name}`,
          shop_id: `${this.shop_id}`,
          confirmed: `${this.confirmed}`
        };

        this.$store.commit("addManagerData", params);
        this.GetData(this.$store.getters.managerData);

        axios
          .get("http://localhost/php/save_data_manager.php", {
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
        this.shop_id = data1.shop_id;
        this.confirmed = data1.confirmed;

        if (this.confirmed == 1) {
          vm.GetProducts();
        }

        axios
          .get("http://localhost/php/get_shops.php", {})
          .then(function (response) {
            vm.shops = response.data.shops;
          });
      },
      GetProducts() {
        let vm = this;
        axios
          .get(`http://localhost/php/get_products_manager.php?shop=${vm.shop_id}`, {})
          .then(function (response) {
            vm.products = response.data.products;
            vm.orders = response.data.orders;
            vm.categories = response.data.categories;
            vm.popular_product = response.data.popular_product;
          });
      }
    },
    created() {
      this.isManager = this.$store.getters.isManager;
      this.GetData(this.$store.getters.managerData);
    },
    computed: {
            products_filter: function () {
                if (this.id != -1) {
                    return this.products.filter((x) => x.product_id === this.product_id);
                }
            },
        },
  }
</script>

<style>
  .dashboard canvas{
    max-width: 100%;
  }

  .dashboard{
    max-width: 100%;
    margin: auto;
  }

  .form__customer {
    max-width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    align-items: center;
    margin: auto;
    padding: 0;
  }

  .form__customer-data {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    align-items: center;
    margin: auto;
    text-align: center;
    min-width: 60%;
    max-width: 100%;
  }

  .form__customer button{
    margin: 10px;
  }

  .form__customer h1{
    margin: 10px;
  }


  .customer-data__item {
    display: flex;
    flex-direction: column;
    text-align: center;
    min-width: 80%;
    margin: 10px;
  }

  .customer-data__item input {
    background: #e9eff6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    padding: 0 20px;
    width: 100%;
    height: 30px;
    margin: auto;
  }

  .customer-data__item select {
    background: #e9eff6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    padding: 0 20px;
    width: 100%;
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

  .block__window{
     max-width: 100%;
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
        margin: auto;
        padding: 0;
  }
  /* стили для всплывающего окна*/
 #window {
        display: none;
        position: fixed;
        text-align: center;
        align-self: center;
        margin: auto;
        top: 100px;
        max-width: 600px;
        height: 510px;
        background-color: rgb(255, 255, 255);
        padding: 20px 50px;
        color: black;
        border-radius: 20px;
        border: rgb(45, 221, 1) solid 2px;
    }

    .products__button {
        margin: 10px;
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

  /* стили для таблицы */
  table.table-2 {
    border-collapse: collapse;
    border-spacing: 0;
    max-width: 100%;
  }

 table.table-2 tr {
        background-color: #ffffff;
    }

    table.table-2 th,
    table.table-2 td {
        padding: 8px;
        border: 1px solid rgb(28, 28, 28);
        white-space: normal;
        word-break: break-all;
        overflow: visible;
        text-overflow: clip;
        text-align: center;
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
    .table-wrap{
        max-width: 100%;
        flex-direction: column;
        margin: 10px;
        align-items: center;
        justify-content: center;
        text-align: center;
        justify-items: center;
    }

    .table__image {
        max-width: 120px;
        max-height: 120px;
    }
    .id_description{
      text-align:center;
      font-size: 14px;
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

    .admin__menu {
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    li {
      float: none;
      margin-top: 0.5em;
    }

    ul {
      margin: 0;
    }
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
    .data_products__item {
        display: flex;
        flex-direction: column;
        margin: 5px;
    }
  }
</style>