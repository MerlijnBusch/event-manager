import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/views/Home';
import About from '@/js/views/About';
import Example from '@/js/views/Example'
import DropdownExample from '@/js/views/DropdownExample'
import EventForm from '@/js/views/forms/Event-form'
import ResetPasswordForm from '@/js/views/forms/ResetPasswordForm';
import UserRegistrationForm from '@/js/views/forms/User-Registration-form';

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
        },
        {
            path: '/form/event',
            name: 'event-form',
            component: EventForm,
            meta: {
                auth: true
            }
        },
        {
            path: '/reset-password/:token',
            name: 'reset-password-form',
            component: ResetPasswordForm,
        },
        {
            path: '/user-registration',
            name: 'user-registration-form',
            component: UserRegistrationForm
        },
        {
            path: '/dropdown',
            name: 'dropdown',
            component: DropdownExample
        },

    ]
});

export default router;
