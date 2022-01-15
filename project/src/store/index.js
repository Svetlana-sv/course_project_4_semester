import { createStore } from 'vuex'

export default createStore({
  state: {//переменн
    cart_cards: [],
    isCustomer: false,
    isManager: false,
    customerData: [],
    managerData: []
  },
  mutations: {//методы изменяющие переменные
    addItem(state, item){//добавление карт в массив
      
      //console.log(item.product_id);
        if (!(state.cart_cards.includes(item))){
          state.cart_cards.push(item);
        }
    },
    ChangeStatusCustomer(state,status){
      state.isCustomer=status;
    },
    ChangeStatusManager(state,status){
      state.isManager=status;
    },
    addCustomerData(state,data){
      state.customerData=data;
    },
    addManagerData(state,data){
      state.managerData=data;
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
    isManager: state => {return state.isManager;},
    customerData: state => {return state.customerData;},
    managerData: state => {return state.managerData;}
  }
})
