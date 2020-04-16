import './bootstrap'
import Vue from 'vue'
import vuetify from 'vuetify'

import Route from '@/js/routes.js'

import App from '@/js/views/App'

const app = new Vue({
    el: "#app",
    vuetify,
    router: Route,
    render: h => h(App)
})

export default app;
