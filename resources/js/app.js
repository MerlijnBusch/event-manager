import './bootstrap'
import Vue from 'vue'

import Route from '@/js/routes.js'

import App from '@/js/views/App'

const app = new Vue({
    el: "#app",
    router: Route,
    render: h => h(App)
})

export default app;
