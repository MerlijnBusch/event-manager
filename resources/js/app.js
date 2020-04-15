require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Routers from '@/js/routes.js'
Vue.use(VueRouter);

const routes = [
    Routes
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    router
}).$mount('#app');
