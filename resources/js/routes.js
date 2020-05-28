import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/views/Home';
import Event from '@/js/views/Event';
import Profile from '@/js/views/Profile';
import EventForm from '@/js/views/forms/Event-form'
import ResetPasswordForm from '@/js/views/forms/ResetPasswordForm';
import DropdownExample from '@/js/views/DropdownExample'
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
            path: '/event',
            name: 'event',
            component: Event
        },
        {
          path: '/profile',
          name: 'profile',
          component: Profile
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
