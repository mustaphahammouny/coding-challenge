// require('./bootstrap');

import axios from "axios";
import Vue from "vue";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import ProductIndex from "./components/ProductIndex";

window.axios = axios;

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.component('product-index', ProductIndex);

const app = new Vue().$mount('#app');
