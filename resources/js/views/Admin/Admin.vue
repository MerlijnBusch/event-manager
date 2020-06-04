<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div>
                <p>users:</p>
                <div>
                    <div
                            class="admin-sidebar-name-holder"
                            v-on:click="setPage(3)"
                    >
                        <div
                                class="admin-sidebar-text-name"
                        >Rollen en permissions
                        </div>
                    </div>
                    <div
                            class="admin-sidebar-name-holder"
                            v-on:click="setPage(2)"
                    >
                        <div
                                class="admin-sidebar-text-name"
                        >Find user
                        </div>
                    </div>
                    <div
                            class="admin-sidebar-name-holder"
                            v-on:click="setModalState(`uploadExcelUsersModal`)"
                    >
                        <div
                                class="admin-sidebar-text-name"
                        >Upload multiple users (excel)
                        </div>
                    </div>
                </div>
                <p>events:</p>
                <div v-for="event in events" :key="event.name" class="admin-sidebar-event-container">
                    <div
                            class="admin-sidebar-event-list-item"
                            v-on:click="setSelectedEventId(event.id)"
                    >
                        <div class="admin-sidebar-name-holder">
                            <div
                                    class="admin-sidebar-text-name"
                                    v-on:click="eventDropDown(event.id)"
                            >{{event.name}}
                            </div>
                            <div class="admin-sidebar-icon-container">
                                <div
                                        class="admin-sidebar-icon"
                                        v-on:click="openEventSettings(event.id)"
                                >
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div
                                        class="admin-sidebar-icon"
                                        v-on:click="setModalState(`updateEventModal`)"
                                >
                                    <i class="fas fa-pencil"></i>
                                </div>
                                <div
                                        class="admin-sidebar-icon"
                                        v-on:click="deleteEvent(event.id)"
                                        title="evenment verweideren"
                                >
                                    <i class="fas fa-trash"></i>
                                </div>
                            </div>
                        </div>
                        <div :id="'event-' + event.id" class="admin-sidebar-display-event-options">
                            <div v-if="event.program" v-for="prog in event.program">
                                <div class="admin-sidebar-program-container" v-if="prog.event_id === event.id">
                                    <div class="admin-sidebar-program-title"
                                         v-on:click="updateDisplay(prog)">
                                        {{prog.name}}
                                    </div>
                                    <div class="admin-sidebar-program-action-container">
                                        <div class="admin-sidebar-program-action-update">
                                            <i class="fas fa-pencil"></i>
                                        </div>
                                        <div
                                                class="admin-sidebar-program-action-delete"
                                                v-on:click="deleteProgram(prog.id)"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                    class="admin-create-program-sidebar"
                                    v-on:click="setModalState(`createProgramModal`)"
                            >
                                <div class="admin-sidebar-program-create-button">
                                    <i class="fas fa-plus-circle"></i> Create Program
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin-sidebar-create-event-container">
                <div
                        class="admin-create-event-sidebar"
                        v-on:click="setModalState(`createEventModal`)"
                >
                    <i class="fas fa-plus-circle admin-sidebar-event-create-icon"></i>Create Event
                </div>
            </div>
        </div>
        <div class="admin-main">
            <div class="admin-main-program-container" v-if="program && page === 1">
                <program v-if="program" v-bind:program="program"></program>
                <div class="admin-item-container" v-if="program">
                    <div class="admin-item-list">
                        <div class="admin-block-list">
                            <div v-for="block in program.block" class="admin-block-list-holder">
                                <div
                                        class="admin-block-list-header"
                                >
                                    <div
                                            class="admin-block-date-holder"
                                    >
                                        <div
                                                class="admin-block-list-date"
                                                v-on:click="displayBlockItems(block.id, block.items.length)"
                                        >
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
                                <div class="admin-block-item-list" :id="'block-items-' + block.id">
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
            <div v-if="page === 1" class="admin-item-container-footer"></div>
            <find-user v-if="page === 2"></find-user>
            <rolls v-if="page === 3"></rolls>
        </div>

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

        <upload-excel-users-modal
                v-show="uploadExcelUsersModal"
                @close="setModalState(`uploadExcelUsersModal`)"
        />

        <update-event-modal
                v-if="currentEvent.event"
                v-bind:id="currentEvent.event.id"
                v-show="updateEventModal"
                @close="setModalState(`updateEventModal`)"
        />

        <create-event-settings-modal
                v-if="settingsId"
                v-bind:id="settingsId"
                v-show="createEventSettingsModal"
                @close="setModalState(`createEventSettingsModal`)"
        />

    </div>
</template>

<script>
    import API from "@/js/Api";
    import Program from "./components/Program";
    import Item from "./components/Item";
    import Settings from "./components/Settings";
    import CreateEventModal from "./components/modal/CreateEventModal";
    import CreateProgramModal from "./components/modal/CreateProgramModal";
    import CreateBlockModal from "./components/modal/CreateBlockModal";
    import CreateItemModal from "./components/modal/CreateItemModal";
    import UpdateEventSettingsModal from "./components/modal/UpdateEventSettingsModal";
    import UpdateBlockModal from "./components/modal/UpdateBlockModal";
    import UploadExcelUsersModal from "./components/modal/UploadExcelUsersModal";
    import UpdateEventModal from "./components/modal/UpdateEventModal";
    import FindUser from "./components/FindUser";
    import Rolls from "./components/Rolls";
    import CreateEventSettingsModal from "./components/modal/CreateEventSettingsModal";

    export default {
        name: 'Admin',
        data() {
            return {
                page: 1,
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
                uploadExcelUsersModal: false,
                updateEventModal: false,
                createEventSettingsModal: false,
                settingsId: null,
                timeOut: null,
            }
        },
        components: {
            Program,
            Item,
            Settings,
            CreateEventModal,
            CreateProgramModal,
            CreateBlockModal,
            CreateItemModal,
            UpdateEventSettingsModal,
            UpdateBlockModal,
            UploadExcelUsersModal,
            UpdateEventModal,
            FindUser,
            Rolls,
            CreateEventSettingsModal,
        },
        methods: {
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                if (this.timeOut !== null) return;
                this.timeOut = await setTimeout(async () => {
                    const data = await API.get('/api/admin/' + id);
                    this.currentEvent = data.data;
                }, 1000);
            },
            setPage(id) {
                this.page = id;
            },
            eventDropDown(id) {
                let target = document.getElementById('event-' + id);
                let height = target.getBoundingClientRect().height;
                if (height === 0) target.style.maxHeight = "500px";
                else target.style.maxHeight = "0";
            },
            updateDisplay(display) {
                this.program = display;
                this.setPage(1);
                this.timeOut = null;
            },
            async setModalState(state) {
                this[state] = !this[state];
                if (this.selectedEventId) await this.setSelectedEventId(this.selectedEventId);
                this.forceUpdate();
            },
            forceUpdate() {
                if (this.currentEvent && this.currentEvent.programs) {
                    this.currentEvent.programs.forEach((item, index) => {
                        if (item.id === this.program.id) this.program = this.currentEvent.programs[index];
                    })
                }
                setTimeout(async () => {
                    const data = await API.get('/api/admin');
                    this.events = data.data;
                }, 0)
            },
            addItemToBlock(id) {
                this.blockId = id;
                this.setModalState('createItemModal');
            },
            updateBlock(id) {
                this.updateBlockId = id;
                this.setModalState('updateBlockModal');
            },
            async deleteEvent(id) {
                if (!confirm('Weet u zeker dat u dit event wilt verwiederen')) return;
                if (!this.currentEvent.event && id === this.currentEvent.event.id) {
                    this.selectedEventId = null;
                    this.currentEvent = null;
                }
                if (this.selectedEventId) API.delete('/api/event/' + id);
                if (this.selectedEventId) await this.setSelectedEventId(this.selectedEventId);
                this.forceUpdate();
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
            },
            displayBlockActions(id) {
                let target = document.getElementById('block-' + id)
                let width = target.getBoundingClientRect().width;
                if (width === 0) target.style.width = "120px";
                else target.style.width = "0px";
            },
            displayBlockItems(id, amount) {
                let target = document.getElementById('block-items-' + id)
                let height = target.getBoundingClientRect().height;
                if (height === 0) target.style.height = (60 * amount) + "px";
                else target.style.height = "0px";
            },
            openEventSettings(id) {
                this.settingsId = id;
                console.log(id)
                this.setModalState(`createEventSettingsModal`)
            }
        },
        async mounted() {
            this.forceUpdate();
        },
    }
</script>
