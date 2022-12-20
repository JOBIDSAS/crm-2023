import Vue from "vue";
import 'vuetify/dist/vuetify.min.css';
import Vuetify from "vuetify";
import 'element-ui/lib/theme-chalk/index.css';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/fr'


import Crm from "./Crm.vue";
import router from "./modules/router";
import store from "./modules/store";

Vue.config.productionTip = false;

Vue.use(Vuetify);
Vue.use(ElementUI, { locale })
Vue.component('crm',Crm)
const EventBus = new Vue();
Vue.prototype.$bus = EventBus;

const app = new Vue({
  el: '#main',
  vuetify: new Vuetify(),
  router,
  store,
  render: h => h(Crm),
});