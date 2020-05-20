<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div class="admin-sidebar-event-list-item" v-on:click="setSelectedEventId(event.id)">{{event.name}}
                    <div v-if="currentEvent.settings" class="admin-sidebar-event-settings"
                         v-on:click="updateDisplay(currentEvent.settings, false)">
                        Event settings
                    </div>
                    <div v-if="currentEvent.programs" v-for="program in currentEvent.programs">
                        <div class="admin-sidebar-program-container">
                            <div class="admin-sidebar-program-title" v-on:click="updateDisplay(program)">
                                {{program.name}}
                            </div>
                            <div class="admin-sidebar-program-action-container">
                                <div class="admin-sidebar-program-action-update"></div>
                                <div class="admin-sidebar-program-action-delete"></div>
                            </div>
                        </div>
                    </div>
                    <div v-if="currentEvent.event">
                        <div v-if="event.id === currentEvent.event.id">
                            <div
                                class="admin-create-program-sidebar"
                                v-on:click="setModalState(`createProgramModal`)"
                            >
                                Create Program
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div
                    class="admin-create-event-sidebar"
                    v-on:click="setModalState(`createEventModal`)"
                >
                    Create Event
                </div>
            </div>
        </div>
        <div class="admin-main">
            <event v-if="this.currentEvent.event" v-bind:event="currentEvent.event"></event>
            <settings v-if="settings" v-bind:settings="settings"></settings>
            <program v-if="program" v-bind:program="program"></program>
            <div class="admin-item-container" v-if="program">
                <div class="admin-item-list">
                    <div v-for="block in program.block" class="admin-block-list-holder">
                        {{block.date_start}}<br>
                        {{block.date_end}}
                        <div v-for="item in block.items" class="admin-item-list-holder">
                            <div>{{item.name}}</div>
                            <div class="admin-sidebar-item-action-container">
                                <div class="admin-sidebar-item-action-update"></div>
                                <div class="admin-sidebar-item-action-delete"></div>
                            </div>
                        </div>
                        <h1>add item</h1>
                    </div>
                    <div>
                        <div
                            class=""
                            v-on:click="setModalState(`createBlockModal`)"
                        >
                            Add block
                        </div>
                    </div>
                </div>
                <div class="admin-item-display-container">
                    <div v-for="block in program.block" class="admin-item-display-container-for">
                        <div v-for="item in block.items">
                            <item v-bind:item="item"></item>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-block-modal
            v-if="program"
            v-show="createBlockModal"
            v-bind:program_id="program.id"
            @close="setModalState(`createBlockModal`)"
        />

        <create-program-modal
            v-if="currentEvent.event"
            v-show="createProgramModal"
            v-bind:event_id="currentEvent.event.id"
            @close="setModalState(`createProgramModal`)"
        />

        <create-event-modal
            v-show="createEventModal"
            @close="setModalState(`createEventModal`)"
        />

    </div>
</template>

<script>
    import API from "@/js/Api";
    import Event from "./components/Event";
    import Program from "./components/Program";
    import Item from "./components/Item";
    import Settings from "./components/Settings";
    import CreateEventModal from "./components/modal/CreateEventModal";
    import CreateProgramModal from "./components/modal/CreateProgramModal";
    import CreateBlockModal from "./components/modal/CreateBlockModal";
    import CreateItemModal from "./components/modal/CreateItemModal";

    export default {
        name: 'Admin',
        data() {
            return {
                events: [],
                selectedEventId: null,
                currentEvent: [],
                program: null,
                settings: null,
                createEventModal: false,
                createProgramModal: false,
                createBlockModal: false,
            }
        },
        components: {
            Event,
            Program,
            Item,
            Settings,
            CreateEventModal,
            CreateProgramModal,
            CreateBlockModal,
            CreateItemModal
        },
        methods: {
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(JSON.parse(JSON.stringify(this.currentEvent)))
            },
            updateDisplay(display, isProgram = true) {
                if (isProgram) { // @todo set settings in modal
                    this.program = display;
                    this.settings = null;
                } else {
                    this.program = null;
                    this.settings = display;
                }
            },
            setModalState(state) {
                this[state] = !this[state];
                if (this.selectedEventId) this.setSelectedEventId(this.selectedEventId)
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
        padding: 16px;
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

    .admin-block-list-holder {
        background-color: green;
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

    .admin-create-event-sidebar {
        width: 100%;
        height: 30px;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .admin-create-program-sidebar {
        width: 100%;
        height: 30px;
        align-items: center;
        justify-content: flex-start;
        display: flex;
    }

    .admin-item-list-holder {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 32px;
    }
</style>
