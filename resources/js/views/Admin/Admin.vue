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
                            <!--for looping programs-->
                            <div v-if="event.program" v-for="prog in event.program">
                                <div class="admin-sidebar-program-container" v-if="prog.event_id === event.id">
                                    <div class="admin-sidebar-program-title"
                                         v-on:click="updateDisplay(prog, 'program')">
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
                            <!--for looping congress-->
                            <div v-if="event.congress" v-for="cong in event.congress">
                                <div class="admin-sidebar-program-container" v-if="cong.event_id === event.id">
                                    <div class="admin-sidebar-program-title"
                                         v-on:click="updateDisplay(cong, 'congress')">
                                        {{cong.name}}
                                    </div>
                                    <div class="admin-sidebar-program-action-container">
                                        <div class="admin-sidebar-program-action-update">
                                            <i class="fas fa-pencil"></i>
                                        </div>
                                        <div
                                            class="admin-sidebar-program-action-delete"
                                            v-on:click="deleteCongress(cong.id)"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-action-container">
                                <div
                                    class="admin-create-program-sidebar"
                                >
                                    <div class="admin-sidebar-program-create-button"
                                         v-on:click="setModalState(`createProgramModal`)">
                                        <i class="fas fa-plus-circle"></i> Create Program
                                    </div>
                                </div>

                                <div
                                    class="admin-create-program-sidebar"
                                >
                                    <div class="admin-sidebar-program-create-button"
                                         v-on:click="setModalState(`createCongressModal`)">
                                        <i class="fas fa-plus-circle"></i> Create Congress
                                    </div>
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
            <congress-display
                v-if="page === 1 && displayType === 'congress'"
                v-bind:congress="display"
            ></congress-display>
            <program-display
                v-if="page === 1 && displayType === 'program'"
                v-bind:program="display"
            ></program-display>
            <div v-if="page === 1" class="admin-item-container-footer"></div>
            <find-user v-if="page === 2"></find-user>
            <rolls v-if="page === 3"></rolls>
        </div>

        <create-program-modal
            v-if="currentEvent"
            v-show="createProgramModal"
            v-bind:id="currentEvent.id"
            @close="setModalState(`createProgramModal`)"
        />

        <create-congress-modal
            v-if="currentEvent"
            v-show="createCongressModal"
            v-bind:id="currentEvent.id"
            @close="setModalState(`createCongressModal`)"
        />

        <create-event-modal
            v-show="createEventModal"
            @close="setModalState(`createEventModal`)"
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
    import Item from "./components/Item";
    import Settings from "./components/Settings";
    import CreateEventModal from "./components/modal/Create/CreateEventModal";
    import CreateProgramModal from "./components/modal/Create/CreateProgramModal";
    import UpdateEventSettingsModal from "./components/modal/Update/UpdateEventSettingsModal";
    import UploadExcelUsersModal from "./components/modal/UploadExcelUsersModal";
    import UpdateEventModal from "./components/modal/Update/UpdateEventModal";
    import FindUser from "./components/FindUser";
    import Rolls from "./components/Rolls";
    import CreateEventSettingsModal from "./components/modal/Create/CreateEventSettingsModal";
    import CreateCongressModal from "./components/modal/Create/CreateCongressModal";
    import CongressDisplay from "./components/CongressDisplay";
    import ProgramDisplay from "./components/ProgramDisplay";

    export default {
        name: 'Admin',
        data() {
            return {
                page: 1,
                events: [],
                selectedEventId: null,
                currentEvent: [],
                display: null,
                updateBlockId: null,
                createEventModal: false,
                createProgramModal: false,
                updateEventSettingsModal: false,
                uploadExcelUsersModal: false,
                updateEventModal: false,
                createEventSettingsModal: false,
                createCongressModal: false,
                settingsId: null,
                displayType: null,
            }
        },
        components: {
            Item,
            Settings,
            CreateEventModal,
            CreateProgramModal,
            UpdateEventSettingsModal,
            UploadExcelUsersModal,
            UpdateEventModal,
            FindUser,
            Rolls,
            CreateEventSettingsModal,
            CreateCongressModal,
            CongressDisplay,
            ProgramDisplay,
        },
        methods: {
            async setSelectedEventId(id) {
                this.selectedEventId = id;
                const data = await API.get('/api/admin/' + id);
                this.currentEvent = data.data;
                console.log(this.currentEvent, 'current event');
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
            updateDisplay(display, type) {
                console.log(display, 'display', type);
                this.displayType = type;
                this.display = display;
                this.setPage(1);
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
                    console.log(this.events);
                }, 0)
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
            async deleteProgram(id) {
                API.delete('/api/program/' + id);
                this.forceUpdate();
            },
            async deleteCongress(id) {
                API.delete('/api/congress/' + id);
                this.forceUpdate();
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
