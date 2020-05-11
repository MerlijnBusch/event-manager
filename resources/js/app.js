import './bootstrap'
import Vue from 'vue'

const user = {
    data: {}
}

user.install = function(){
    Object.defineProperty(Vue.prototype, '$user', {
        get () { return user }
    })
}

Vue.use(user);

import Route from '@/js/routes.js'

import App from '@/js/views/App'
import router from "./routes";

Route.beforeEach((to, from, next) => {
    if ((!!to.meta.auth && to.meta.auth) || (!!to.params.loggedIn && !to.params.loggedIn)) {
        if (!!user.data.api_key){
            next();
        } else {
            to.params.loggedIn = false;
            next();
        }

    } else {
        next();
    }
});

Route.beforeEach((to, from, next) => {
    if ((!!to.meta.auth && to.meta.auth) || (!!to.params.loggedIn && !to.params.loggedIn)) {
        if (!!user.data.api_key){
            next();
        } else {
            to.params.loggedIn = false;
            next();
        }

    } else {
        next();
    }
});

const app = new Vue({
    el: "#app",
    router: Route,
    render: h => h(App)
});



export default app;
