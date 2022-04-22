import BootstrapVue from 'bootstrap-vue'
import "bootstrap-vue/dist/bootstrap-vue.css"
import App from './App.vue';
import router from './router';

window.Vue = require('vue');
Vue.use(BootstrapVue)


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
