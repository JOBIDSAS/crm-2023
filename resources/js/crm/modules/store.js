import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

let store = new Vuex.Store({
  state: {
    drawerActive:true,
    debalActive:false,

    user:{
      logged:false,
      level:null,
      data:null,
    },

  },

  actions:{
    userClear(){
      this.state.user.logged = false
      this.state.user.level = null
      this.state.user.data = null
    },
  },

  getters:{
  },
  
  mutations:{

    userInfo(state,data){
      state.user.logged = data.logged
      state.user.level = data.userlevel
      state.user.data = data.userData
    },

    userClear(state,payload){
      state.user.logged = false
      state.user.level = null
      state.user.data = null
    },

  },

})

export default store;