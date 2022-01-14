import { createRouter, createWebHashHistory } from 'vue-router'
import Main from '../views/Main.vue'
import signinadmin from '../views/SignInAdmin.vue'


const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main
  },
  {
    path: '/signin',
    name: 'SignIn',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/SignIn.vue')
    }
  },
  {
    path: '/admin',
    name: 'SignInAdmin',
    component: signinadmin
  },
  {
    path: '/adminaccount',
    name: 'AdminAccount',
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/AdminAccount.vue')
    }
  },
  {
    path: '/customeraccount',
    name: 'CustomerAccount',
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/CustomerAccount.vue')
    }
  },
  {
    path: '/manageraccount',
    name: 'ManagerAccount',
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/ManagerAccount.vue')
    }
  },
  {
    path: '/catalog',
    name: 'Catalog',
    component: function () {
      return import('../views/Catalog.vue')
    }
  },
  {
    path: '/cart',
    name: 'Cart',
    component: function () {
      return import('../views/Cart.vue')
    }
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
