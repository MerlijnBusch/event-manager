<template>
    <div class="admin-display-page">
        <div class="admin-display-page-main">
            <div class="admin-display-page-main-title">titel</div>
            <div class="admin-display-page-main-container">
                <div
                    v-for="roll in rolls"
                    class=""
                >
                    <div class="admin-roll-list-item">
                        <div class="admin-roll-list-item-title">
                            {{roll.role_name}}
                        </div>
                        <div class="admin-roll-action-holder">
                            <input
                                class="admin-roll-action-icon-holder"
                                type="checkbox"
                                v-model="roll.selectable"
                                v-on:change="handleChange"
                                :id="roll.id"
                                title="Of de rol ge selecteerd kan worden bij het regristeren">
                            <div
                                class="admin-roll-action-icon-holder"
                                v-on:click="updateRoll(roll.id)"
                                title="update this roll"
                            >
                                <i class="fas fa-pencil admin-roll-action-icon"></i>
                            </div>
                            <div
                                class="admin-roll-action-icon-holder"
                                v-on:click="deleteRoll(roll.id)"
                                title="delete this roll"
                            >
                                <i class="fas fa-trash admin-roll-action-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-on:click="setModalState('createRollModal')"
                    class="admin-role-create-container"
                >
                    <i class="fas fa-plus-circle admin-role-create-icon"></i>create role
                </div>
            </div>
        </div>
        <div class="admin-item-container-footer"></div>

        <update-role-modal
            v-bind:id="rollId"
            v-show="updateRollModal"
            @close="setModalState(`updateRollModal`)"
        />

        <create-role-modal
            v-show="createRollModal"
            @close="setModalState(`createRollModal`)"
        />

    </div>
</template>

<script>
    import API from "../../../Api";
    import UpdateRoleModal from "./modal/Update/UpdateRoleModal";
    import CreateRoleModal from "./modal/Create/CreateRoleModal";

    export default {
        name: 'Rolls',
        data() {
            return {
                rolls: [],
                updateRollModal: false,
                createRollModal: false,
                rollId: null,
            }
        },
        components: {
            UpdateRoleModal,
            CreateRoleModal
        },
        methods: {
            handleChange(e) {
                e.preventDefault();

                let target = e.target;
                if(target.checked !== false) {
                    if (confirm('Weet u zeker dat elke gebruiker deze rol kan selecteren?')) {
                        API.get('/api/role-update-selectable/' + target.id)
                    } else {
                        setTimeout(() => {
                            target.checked = false;
                        }, 100)
                    }
                } else {
                    API.get('/api/role-update-selectable/' + target.id)
                }
            },
            async setModalState(state) {
                this[state] = !this[state];
                const res = await API.get('/api/role');
                this.rolls = res.data;
            },
            updateRoll(id) {
                this.rollId = id;
                this.setModalState('updateRollModal')
            },
            deleteRoll(id) {
                if (confirm('Weet u zeker dat u deze rol wilt verweideren')) {
                    API.delete('/api/role/' + id);
                }
            }
        },
        async mounted() {
            const res = await API.get('/api/role');
            this.rolls = res.data;
        }
    }
</script>

