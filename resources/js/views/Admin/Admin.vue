<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div class="admin-sidebar-event-list-item" v-on:click="setSelectedEventId(event.id)">{{event.name}}
                </div>
                <div v-if="currentEvent.programs" v-for="program in currentEvent.programs">
                    <div class="admin-sidebar-program-container">
                        <div class="admin-sidebar-program-title" v-on:click="displayProgram(program)">{{program.name}}</div>
                        <div class="admin-sidebar-program-action-container">
                            <div class="admin-sidebar-program-action-update"></div>
                            <div class="admin-sidebar-program-action-delete"></div>
                        </div>
                    </div>
                </div>
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
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(this.debug(this.currentEvent));
            },
            displayProgram(program) {
                console.log(this.debug(program));
            },
            debug(data) {
                return JSON.parse(JSON.stringify(data))
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

    .admin-program-container {

    }

    .admin-sidebar-event-list-item {
        font-size: larger;
        justify-content: center;
        align-items: center;
        padding: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-sidebar-program-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 32px;
        padding-left: 16px;
        border-bottom: 2px solid lightblue;
    }

    .admin-sidebar-program-action-container {
        display: flex;
        flex-direction: row;
        align-content: center;
    }

    .admin-sidebar-program-action-update {
        background: orange;
        width: 30px;
        height: 30px;
    }

    .admin-sidebar-program-action-delete {
        background: red;
        width: 30px;
        height: 30px;
    }

    .admin-sidebar-program-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>
