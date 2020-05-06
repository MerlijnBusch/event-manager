import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Example from '@/js/components/Example'
import EventForm from '@/js/components/forms/Event-form'
import ResetPasswordForm from '@/js/components/ResetPasswordForm';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta: {
                auth: true
            }
        },
        {
            path: '/form/event',
            name: 'event-form',
            component: EventForm
        },
        {
            path: '/reset-password/:token',
            name: 'reset-password-form',
            component: ResetPasswordForm,
            meta: {
                auth: false
            }
        },
        {
            path: '/example',
            name: 'example',
            component: Example
        },

    ]
});

router.beforeEach((to, from, next) => {
    if (!!to.meta.auth && to.meta.auth) {
    // auth here and then call for "next();"
        next();
    } else {
        next();
    }
});

export default router;
