<template>
    <div class="admin__panel">
        <div class="admin__menu">
            <ul>
                <li>
                    <button @click="changePage('clients')">Все клиенты</button>
                </li>
                <li>
                    <button @click="changePage('managers')">Все менеджеры</button>
                </li>
                <li>
                    <button @click="changePage('products')">Все продукты</button>
                </li>
                <li>
                    <button @click="changePage('statistic')">Статистика</button>
                </li>
            </ul>
        </div>
        <!-- Вкладка клиенты -->
        <div v-if="page=='clients'">
            <h1>Все клиенты</h1>
            <div class="table-wrap">
                <table class="table-2">
                    <tr>
                        <td class="td_id">customer_id</td>
                        <td>first_name</td>
                        <td>middle_name</td>
                        <td>last_name</td>
                        <td>city</td>
                        <td>count_orders</td>
                    </tr>
                    <tr v-for="(customer, index) in customers" :key="index">
                        <td class="td_id">{{ customer.customer_id }}</td>
                        <td>{{ customer.first_name }}</td>
                        <td>{{ customer.middle_name }}</td>
                        <td>{{ customer.last_name }}</td>
                        <td>{{ customer.city }}</td>
                        <td>{{ customer.count_orders }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Статистика -->
        <div v-if="page=='statistic'">
            <div class="dashboard">
                <br>
                <p>Количество продуктов</p>
                <pie-chart :download="{background: '#fff'}" legend="right" :data="products_dashboard"></pie-chart>
            </div>
            <div class="dashboard">
                <br>
                <p>Количество заказов</p>
                <line-chart :download="{background: '#fff'}" :data="test"></line-chart>
            </div>
        </div>

        <!-- Вкладка менеджеры -->
        <div v-if="page=='managers'">
            <h1>Все менеджеры</h1>
            <div class="table-wrap">
                <table class="table-2">
                    <tr>
                        <td class="td_id">manager_id</td>
                        <td>first_name</td>
                        <td>middle_name</td>
                        <td>last_name</td>
                        <td>shop</td>
                        <td>confirmed</td>
                        <td>status</td>
                    </tr>
                    <tr v-for="(manager, index) in managers" :key="index">
                        <td class="td_id">{{ manager.manager_id }}</td>
                        <td>{{ manager.first_name }}</td>
                        <td>{{ manager.middle_name }}</td>
                        <td>{{ manager.last_name }}</td>
                        <td>{{ manager.shop_name }}</td>
                        <td>{{ manager.confirmed }}</td>
                        <td><button @click="changeStatusConfirmed(manager.manager_id)">Изменить статус</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Вкладка продукты -->
        <div v-if="page=='products'">
            <h1>Продукты</h1>

            <div class="products__button">
                <button type="submit" @click="AddProduct()">Добавить товар</button>
            </div>

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
                    <tr @click="onRowClick(product.product_id)" v-for="(product, index) in products" :key="index">
                        <td class="td_id">{{ product.product_id }}</td>
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_discription }}</td>
                        <td>{{ product.shop_name }}</td>
                        <td>{{ product.category_name }}</td>
                        <td class="td_img">
                            <img :src="product.product_image" alt=""
                                class="table__image" /><br />{{ product.product_image }}
                        </td>
                        <td class="td_price">{{ product.price }}</td>
                        <td>{{ product.quantity_name }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Всплывающее окно -->
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
                    <label for="">Магазин:</label>
                    <select v-model="selectedShop">
                        <option :value="s.shop_id" v-for="(s, index) in shops" :key="index">
                            {{ s.shop_name }}
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
</template>

<script>
    import axios from "axios";

    export default {
        name: "admin",
        data() {
            return {
                test: {
                    '2017-05-13': 2,
                    '2017-05-14': 5
                },
                products_dashboard: [
                    ['Blueberry', 44],
                    ['Strawberry', 23]
                ],
                products: [],
                customers: [],
                managers: [],
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
                page: "clients"
            };
        },
        mounted: function () {
            //this.getTableData();
        },
        methods: {
            changePage(page) {
                this.page = page;
            },
            getPath(link) {
                return link;
            },
            GetDataDashboard() {
                let vm = this;
                axios
                    .get("http://localhost/php/get_orders_dashboard.php")
                    .then(function (response) {
                        var data = response.data.test;
                        vm.test = response.data.test;

                        vm.test = [];
                        data.forEach(element => {
                            vm.test.push([`${element.order_data}`, element.count])
                        });

                        var data = response.data.products;
                        vm.products_dashboard = response.data.products;

                        vm.products_dashboard = [];
                        data.forEach(element => {
                            vm.products_dashboard.push([`${element.product_name}`, element.amount])
                        });
                    });
                console.log(this.test);
            },
            changeStatusConfirmed(id) {
                let vm = this;
                axios
                    .get(
                        `http://localhost/php/change_status_confirmed.php?
                manager_id=${id}`
                    )
                    .then(function (response) {
                        alert("Изменено!");
                        vm.getTableManagers();
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
            getTableCustomers() {
                let vm = this;
                axios
                    .get("http://localhost/php/get_table_customers.php")
                    .then(function (response) {
                        vm.customers = response.data.customers;
                    });
            },
            getTableManagers() {
                let vm = this;
                axios
                    .get("http://localhost/php/get_table_managers.php")
                    .then(function (response) {
                        vm.managers = response.data.managers;
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
            this.getTableCustomers();
            this.getTableManagers();
            this.GetDataDashboard();
        },
    };
</script>

<style>
    .dashboard canvas {
        max-width: 100%;
    }

    .dashboard {
        max-width: 100%;
        margin: auto;
    }

    .admin__menu {
        display: flex;
        flex-direction: row;
        vertical-align: middle;
        margin: 10px;
    }

    .admin__panel h1 {
        margin: 10px;
    }

    ul {
        list-style: none;
        margin: auto;
        padding: 0px;
    }

    li {
        float: left;
        padding-right: 10px;
        padding-left: 10px;
        font-family: 'Dela Gothic One', cursive;
    }

    .admin__panel {
        max-width: 100%;
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
        margin: auto;
        padding: 0;
    }

    /* форма */
    .signin {
        max-width: 100%;
        min-height: 100%;
        text-align: center;
    }

    .signin__form {
        max-width: 80%;
        margin: auto;
        margin-top: 50px;
        padding: 0;
        padding: 50px;
        border: rgb(10, 191, 0) solid 1px;
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

    .td_id {
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

        .td_id {
            background-color: rgb(150, 150, 150);
            border: 3px solid rgb(28, 28, 28);
        }

        .admin__menu {
            flex-direction: column;
            margin: 5px;
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
    }

    .table__image {
        max-width: 120px;
        max-height: 120px;
    }

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

    button {
        height: 45px;
        width: 160px;
        border-radius: 20px;
        margin: auto;
    }
</style>