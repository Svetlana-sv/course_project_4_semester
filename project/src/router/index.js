import { createRouter, createWebHashHistory } from 'vue-router'
import Main from '../views/Main.vue'
import admin from '../views/Admin.vue'


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
    name: 'admin',
    component: admin
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
