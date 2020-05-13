import Vue from 'vue';
import VueRouter from "vue-router";

import Home from '@/js/views/Home';
import About from '@/js/views/About';
import Example from '@/js/views/Example'
import DropdownExample from '@/js/views/DropdownExample'
import EventForm from '@/js/views/forms/Event-form'
import ResetPasswordForm from '@/js/views/forms/ResetPasswordForm';
import EventSettingsForm from '@/js/views/forms/Event-Settings-form'
import RoleForm from '@/js/views/forms/Role-form'
import MapForm from '@/js/views/forms/Map-form'
import ProfileForm from '@/js/views/forms/Profile-form'
import CVForm from '@/js/views/forms/CV-form'

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
            path: '/form/profile',
            name: 'profile-form',
            component: ProfileForm
        },
        {
            path: '/form/profile-cv',
            name: 'profile-cv-form',
            component: CVForm
        },
        {
            path: '/form/event-settings/:event_id',
            name: 'event-settings-form',
            component: EventSettingsForm,
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
