<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div class="admin-sidebar-event-list-item" v-on:click="setSelectedEventId(event.id)">{{event.name}}</div>
            </div>
        </div>
        <div class="admin-main">
            <div class="admin-event-container">
                <h1>test</h1>
            </div>
            <div class="admin-program-container">

            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";

    export default {
        name: 'Role-Form',
        data() {
            return {
                events: [],
                selectedEventId: null,
            }
        },
        methods: {
            setSelectedEventId(id){
                console.log(id)
                this.selectedEventId = id;
            },
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

    }

    .admin-program-container {

    }

    .admin-sidebar-event-list-item {
    }
</style>
