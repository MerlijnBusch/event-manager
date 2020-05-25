<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                <div
                    class="admin-sidebar-event-list-item"
                    v-on:click="setSelectedEventId(event.id)"
                >
                    <div class="admin-sidebar-event-name-holder">
                        <div class="admin-sidebar-event-name">{{event.name}}</div>
                        <div class="admin-sidebar-event-name-stripe"></div>
                    </div>
                    <div v-if="currentEvent.programs" v-for="program in currentEvent.programs">
                        <div class="admin-sidebar-program-container" v-if="program.event_id === event.id">
                            <div class="admin-sidebar-program-title"
                                 v-on:click="updateDisplay(program)">
                                {{program.name}}
                            </div>
                            <div class="admin-sidebar-program-action-container">
                                <div class="admin-sidebar-program-action-update">
                                    <i class="fas fa-pencil"></i>
                                </div>
                                <div
                                    class="admin-sidebar-program-action-delete"
                                    v-on:click="deleteProgram(program.id)"
                                >
                                    <i class="fas fa-trash"></i>
                                </div>
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
            <div class="admin-main-program-container" v-if="program">
                <program v-if="program" v-bind:program="program"></program>
                <div class="admin-item-container" v-if="program">
                    <div class="admin-item-list">
                        <div class="admin-block-list">
                            <div v-for="block in program.block" class="admin-block-list-holder">
                                <div
                                    class="admin-block-list-header"

                                >
                                    <div class="admin-block-date-holder">
                                        <div class="admin-block-list-date">
                                            {{block.date_start.slice(5)}} / {{block.date_end.slice(5)}}
                                        </div>
                                        <div
                                            class="admin-block-action"
                                            v-on:click="displayBlockActions(block.id)"
                                        >
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="admin-block-action-holder" :id="'block-' + block.id">
                                            <div
                                                class="admin-block-action-icon-holder"
                                                v-on:click="addItemToBlock(block.id)"
                                                title="add item"
                                            >
                                                <i class="fas fa-plus-circle admin-block-action-icon"></i>
                                            </div>
                                            <div
                                                class="admin-block-action-icon-holder"
                                                v-on:click="updateBlock(block.id)"
                                                title="update this block"
                                            >
                                                <i class="fas fa-pencil admin-block-action-icon"></i>
                                            </div>
                                            <div
                                                class="admin-block-action-icon-holder"
                                                v-on:click="deleteBlock(block.id)"
                                                title="delete this block"
                                            >
                                                <i class="fas fa-trash admin-block-action-icon"></i>
                                            </div>
                                    </div>
                                </div>
                                <div v-for="item in block.items" class="admin-item-list-holder">
                                    <div>{{item.name}}</div>
                                    <div class="admin-sidebar-item-action-container">
                                        <div class="admin-sidebar-item-action-update">
                                            <i class="fas fa-pencil"></i>
                                        </div>
                                        <div class="admin-sidebar-item-action-delete">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div
                                class="admin-block-list-add-block"
                                v-on:click="setModalState(`createBlockModal`)"
                            >
                                <i class="fas fa-plus-circle admin-block-list-add-icon"></i>Add block
                            </div>
                        </div>
                    </div>
                    <div class="admin-item-display-container">
                        <div v-for="block in program.block" class="admin-item-display-container-for">
                            <div v-for="item in block.items">
                                <item v-bind:item="item"></item>
                                <div class="admin-item-hr"></div>
                            </div>
                        </div>
                    </div>
                    <div class="admin-item-container-line"></div>
                </div>
            </div>
            <div class="admin-item-container-footer"></div>
        </div>

        <!--        <update-event-settings-modal-->
        <!--            v-if="currentEvent.settings"-->
        <!--            v-show="updateEventSettingsModal"-->
        <!--            v-bind:settings="currentEvent.settings"-->
        <!--            @close="setModalState(`updateEventSettingsModal`)"-->
        <!--        />-->

        <create-item-modal
            v-if="blockId"
            v-show="createItemModal"
            v-bind:id="blockId"
            @close="setModalState(`createItemModal`)"
        />

        <create-block-modal
            v-if="program"
            v-show="createBlockModal"
            v-bind:id="program.id"
            @close="setModalState(`createBlockModal`)"
        />

        <create-program-modal
            v-if="currentEvent.event"
            v-show="createProgramModal"
            v-bind:id="currentEvent.event.id"
            @close="setModalState(`createProgramModal`)"
        />

        <create-event-modal
            v-show="createEventModal"
            @close="setModalState(`createEventModal`)"
        />

        <update-block-modal
            v-if="updateBlockId"
            v-bind:id="updateBlockId"
            v-show="updateBlockModal"
            @close="setModalState(`updateBlockModal`)"
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
    import UpdateEventSettingsModal from "./components/modal/UpdateEventSettingsModal";
    import UpdateBlockModal from "./components/modal/UpdateBlockModal";

    export default {
        name: 'Admin',
        data() {
            return {
                events: [],
                selectedEventId: null,
                currentEvent: [],
                program: null,
                blockId: null,
                updateBlockId: null,
                createEventModal: false,
                createProgramModal: false,
                createBlockModal: false,
                createItemModal: false,
                updateEventSettingsModal: false,
                updateBlockModal: false,
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
            CreateItemModal,
            UpdateEventSettingsModal,
            UpdateBlockModal
        },
        methods: {
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(JSON.parse(JSON.stringify(this.currentEvent)))
            },
            updateDisplay(display) {
                this.program = display;
            },
            async setModalState(state) {
                this[state] = !this[state];
                if (this.selectedEventId) await this.setSelectedEventId(this.selectedEventId);
                this.forceUpdate();
            },
            forceUpdate() {
                this.currentEvent.programs.forEach((item, index) => {
                    if (item.id === this.program.id) this.program = this.currentEvent.programs[index];
                })
            },
            addItemToBlock(id) {
                this.blockId = id;
                this.setModalState('createItemModal');
            },
            updateBlock(id) {
                this.updateBlockId = id;
                this.setModalState('updateBlockModal');
            },
            async deleteBlock(id) {
                API.delete('/api/block/' + id);
                if (this.selectedEventId) await this.setSelectedEventId(this.selectedEventId);
                this.forceUpdate();
            },
            async deleteProgram(id) {
                API.delete('/api/program/' + id);
                if (this.selectedEventId) await this.setSelectedEventId(this.selectedEventId);
                this.forceUpdate();
            },displayBlockActions(id){
                console.log(id);
                let target = document.getElementById('block-' + id)
                let width = target.getBoundingClientRect().width;
                if(width === 0) target.style.width = "120px";
                else target.style.width = "0px";
            }
        },
        async mounted() {
            const data = await API.get('/api/admin');
            this.events = data.data;
        },
    }
</script>
