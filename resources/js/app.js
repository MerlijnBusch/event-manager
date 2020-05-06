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

const app = new Vue({
    el: "#app",
    router: Route,
    render: h => h(App)
})

export default app;
