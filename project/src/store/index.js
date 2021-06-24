import { createStore } from 'vuex'

export default createStore({
  state: {//переменн
    cart_cards: [],
    isCustomer: false,
    customerData: []
  },
  mutations: {//методы изменяющие переменные
    addItem(state, item){//добавление карт в массив
      
      //console.log(item.product_id);
        if (!(state.cart_cards.includes(item))){
          state.cart_cards.push(item);
        }
    },
    changeStatus(state,status){
      state.isCustomer=status;
    },
    addCustomerData(state,data){
      state.customerData=data;
    }
  },
  actions: {//методы которые вызываюе mutations
    // addItems(context,item){

    // }
  },
  modules: {
  },
  getters: {//возращает переменные
    cart_cards: state => {return state.cart_cards;},
    isCustomer: state => {return state.isCustomer;},
    customerData: state => {return state.customerData;}
  }
})
