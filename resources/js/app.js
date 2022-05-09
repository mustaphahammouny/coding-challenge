// require('./bootstrap');

import axios from "axios";
import Vue from "vue";
import VueRouter from "vue-router";
import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
import * as rules from "vee-validate/dist/rules";
import en from "vee-validate/dist/locale/en.json";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import router from "./router/index";

window.axios = axios;

// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});

localize("en", en);

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

// Install VeeValidate components globally
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);

const app = new Vue({
    router,
}).$mount('#app');
