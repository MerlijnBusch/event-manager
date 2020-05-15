<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div class="admin-sidebar-event-list-item" v-on:click="setSelectedEventId(event.id)">{{event.name}}</div>
            </div>
        </div>
        <div class="admin-main">
            <event-form v-if="this.currentEvent.event" v-bind:event="currentEvent.event"></event-form>
            <div class="admin-event-settings-container" v-if="this.currentEvent.settings">

            </div>
            <div class="admin-program-container">

            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";
    import EventForm from "./components/EventForm";

    export default {
        name: 'Role-Form',
        data() {
            return {
                events: [],
                selectedEventId: null,
                currentEvent: [],
            }
        },
        components: {EventForm},
        methods: {
            async setSelectedEventId(id){
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(this.currentEvent);
            }
        },
        async mounted() {
            const data = await API.get('/api/admin');
            this.events = data.data;
            console.log(data, 'test');

        },
    }
</script>

<style>
    .admin-container {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: row;
        flex: 1;
    }

    .admin-sidebar {
        min-width: 285px;
        max-width: 285px;
    }

    .admin-sidebar-event-container {
        padding: 8px;
        width: 100%;
        justify-content: start;
    }

    .admin-main {
        flex: 1;
        background-color: yellow;
    }

    .admin-event-container {
        padding: 16px;
        margin-top: 4px;
    }

    .admin-program-container {

    }

    .admin-sidebar-event-list-item {
    }

    .admin-text-editor {
        margin-top: 8px;
    }

    .ql-editor {
        max-height: 200px !important;
    }

    .admin-event-title-input {
        background: transparent;
        outline: transparent;
        border: transparent;
        width: 100%;
        font-size: xx-large;
    }

    .admin-event-title-input:focus {
        border-bottom: 2px solid lightblue;
    }
</style>
