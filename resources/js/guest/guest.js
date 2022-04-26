import BootstrapVue from 'bootstrap-vue'
import "bootstrap-vue/dist/bootstrap-vue.css"
import App from './App.vue';
import router from './router';

import '@fortawesome/fontawesome-free/css/all.css';
// import '@fortawesome/fontawesome-free/js/all.js';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.Vue = require('vue');
Vue.use(BootstrapVue)


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
