import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Event from '@/js/components/Event';
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
            path: '/event',
            name: 'event',
            component: Event
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/reset-password/:token',
            name: 'reset-password-form',
            component: ResetPasswordForm,
            meta: {
                auth: false
            }
        }

    ]
});

export default router;
