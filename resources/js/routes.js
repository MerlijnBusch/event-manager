import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Example from '@/js/components/Example'
import EventForm from '@/js/components/forms/Event-form'
import EventSettingsForm from '@/js/components/forms/Event-Settings-form'
import RoleForm from '@/js/components/forms/Role-form'
import MapForm from '@/js/components/forms/Map-form'
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
            component: About
        },
        {
            path: '/form/event',
            name: 'event-form',
            component: EventForm,
        },
        {
            path: '/form/map/:event_id',
            name: 'map-form',
            component: MapForm
        },
        {
            path: '/form/role',
            name: 'role-form',
            component: RoleForm
        },
        {
            path: '/form/event-settings/:event_id',
            name: 'event-settings-form',
            component: EventSettingsForm
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

export default router;
