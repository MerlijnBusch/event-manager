<template>
    <div class="admin-item-display-holder" rel="settings_container">
        <h1>Settings</h1>
        <input v-model="date_start" rel="date_start" type="date">
        <input v-model="date_end" rel="date_end" type="date">
        <input v-model="max_registrations" type="text">
        <input v-model="visible_registrations" type="text">
        <input v-model="primary_color" type="color">
        <input v-model="secondary_color" type="color">
    </div>
</template>

<script>
    export default {
        name: 'Settings',
        props: ['settings'],
        data() {
            return {
                date_end: null,
                date_start: null,
                max_registrations: null,
                visible_registrations: null,
                primary_color: null,
                secondary_color: null,
            }
        },
        mounted() {
            this.date_end = this.settings.date_end;
            this.date_start = this.settings.date_start;
            this.max_registrations = this.settings.max_registrations;
            this.visible_registrations = this.settings.visible_registrations;
            this.primary_color = this.settings.primary_color;
            this.secondary_color = this.settings.secondary_color;
        },
    }
</script>

<style>

</style>
