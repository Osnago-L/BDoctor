// VUE 
window.Vue = require('vue');

import App from './App.vue';
import router from './router';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});


// BOOTSTRAP-VUE 
// require('./bootstrap');
// import "./bootstrap"
import BootstrapVue from 'bootstrap-vue'
import "bootstrap-vue/dist/bootstrap-vue.css"

Vue.use(BootstrapVue)

//AXIOS FRONT

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
