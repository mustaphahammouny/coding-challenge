// require('./bootstrap');

import axios from "axios";
import Vue from "vue";
import VueRouter from "vue-router";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import router from "./router/index";

window.axios = axios;

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    router,
}).$mount('#app');
