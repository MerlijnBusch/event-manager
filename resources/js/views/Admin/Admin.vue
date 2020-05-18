<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div class="admin-sidebar-event-list-item" v-on:click="setSelectedEventId(event.id)">{{event.name}}
                </div>
                <div v-if="currentEvent.settings" class="admin-sidebar-event-settings" v-on:click="updateDisplay(currentEvent.settings, false)">
                    Event settings
                </div>
                <div v-if="currentEvent.programs" v-for="program in currentEvent.programs">
                    <div class="admin-sidebar-program-container">
                        <div class="admin-sidebar-program-title" v-on:click="updateDisplay(program)">{{program.name}}
                        </div>
                        <div class="admin-sidebar-program-action-container">
                            <div class="admin-sidebar-program-action-update"></div>
                            <div class="admin-sidebar-program-action-delete"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-main">
            <event v-if="this.currentEvent.event" v-bind:event="currentEvent.event"></event>
            <div class="admin-event-settings-container" v-if="this.currentEvent.settings">

            </div>
            <program v-if="program" v-bind:program="program"></program>
            <div class="admin-item-container" v-if="program">
                <div class="admin-item-list">
                    <div v-for="item in program.items" class="admin-item-list-holder">
                        <div class="admin-item-list-title">{{item.name}}</div>
                        <div class="admin-sidebar-item-action-container">
                            <div class="admin-sidebar-item-action-update"></div>
                            <div class="admin-sidebar-item-action-delete"></div>
                        </div>
                    </div>
                </div>
                <div class="admin-item-display-container">
                    <div v-for="item in program.items" class="admin-item-display-container-for">
                        <item v-bind:item="item"></item>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";
    import Event from "./components/Event";
    import Program from "./components/Program";
    import Item from "./components/Item";

    export default {
        name: 'Role-Form',
        data() {
            return {
                events: [],
                selectedEventId: null,
                currentEvent: [],
                program: null,
                settings: null,
            }
        },
        components: {Event, Program, Item},
        methods: {
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(this.debug(this.currentEvent));
            },
            updateDisplay(display, isProgram = true) {
                if(isProgram) {
                    this.program = display;
                    this.settings = null;
                } else {
                    this.program = null;
                    this.settings = display;
                }
                console.log(this.debug(display));
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
        justify-content: flex-start;
    }

    .admin-main {
        flex: 1;
        background-color: yellow;
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

    .admin-item-container {
        display: flex;
        flex-direction: row;
        flex: 1;
    }

    .admin-item-list {
        width: 200px;
    }

    .admin-item-list-title {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        height: 30px;
        padding: 9px;
    }

    .admin-sidebar-item-action-container {
        display: flex;
        flex-direction: row;
        align-content: center;
    }

    .admin-sidebar-item-action-update {
        background: orange;
        width: 30px;
        height: 30px;
    }

    .admin-sidebar-item-action-delete {
        background: red;
        width: 30px;
        height: 30px;
    }

    .admin-item-list-holder {
        display: flex;
        align-items: center;
        margin-top: 4px;
    }

    .admin-item-display-container {
        display: flex;
        justify-content: flex-start;
        align-content: center;
        flex-direction: column;
        flex: 1;
    }

    .admin-item-display-container-for {
        padding: 8px;
    }

    .admin-sidebar-event-settings {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 32px;
        border-bottom: 2px solid lightblue;
    }
</style>
