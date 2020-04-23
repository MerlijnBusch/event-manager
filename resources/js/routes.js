import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import ForgotPassword from '@/js/components/ForgotPassword';

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
            component: About
        },
        // Moet in modal. {
        //     path: '/reset-password/:token',
        //     name: 'reset-password-form',
        //     component: ResetPasswordForm,
        //     meta: {
        //         auth:false
        //     }
        // }

    ]
});

export default router;
