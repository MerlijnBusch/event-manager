import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/views/Home';
import Event from '@/js/views/Event';
import EventForm from '@/js/views/forms/Event-form'
import ResetPasswordForm from '@/js/views/forms/ResetPasswordForm';
import Example from '@/js/views/Example'
import DropdownExample from '@/js/views/DropdownExample'

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
            path: '/example',
            name: 'example',
            component: Example
        },
        {
            path: '/dropdown',
            name: 'dropdown',
            component: DropdownExample
        },

    ]
});

export default router;
