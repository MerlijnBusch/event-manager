<template>
    <div class="admin-main-program-container">
        <TitleDisplay v-if="program" v-bind:display="program"></TitleDisplay>
        <div class="admin-item-container">
            <div class="admin-item-list">
                <div class="admin-block-list">
                    <div v-for="item in program.program_items" class="admin-item-list-holder">
                        <div>{{item.name}}</div>
                        <div class="admin-sidebar-item-action-container">
                            <div
                                class="admin-sidebar-item-action-update"
                                v-on:click="updateItem(item.id)"
                            >
                                <i class="fas fa-pencil"></i>
                            </div>
                            <div class="admin-sidebar-item-action-delete"
                                 v-on:click="deleteItem(item.id)"
                            >
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div
                        class="admin-block-list-add-block"
                        v-on:click="setModalState(`createProgramItemModal`)"
                    >
                        <i class="fas fa-plus-circle admin-block-list-add-icon"></i>Add Program Item
                    </div>
                </div>
            </div>
            <div class="admin-item-display-container">
                <div v-for="item in program.program_items" class="admin-item-display-container-for">
                    <item v-bind:item="item"></item>
                    <div class="admin-item-hr"></div>
                </div>
            </div>
            <div class="admin-item-container-line"></div>
        </div>

        <create-program-item-modal
            v-if="createProgramItemModal"
            v-show="createProgramItemModal"
            v-bind:id="program.id"
            @close="setModalState(`createProgramItemModal`)"
        />

        <update-program-item-modal
            v-show="updateProgramItemModal"
            v-bind:id="ItemId"
            @close="setModalState(`updateProgramItemModal`)"
        />

    </div>
</template>

<script>
    import TitleDisplay from "./TitleDisplay";
    import Item from "./Item";
    import CreateProgramItemModal from "./modal/Create/CreateProgramItemModal";
    import UpdateProgramItemModal from "./modal/Update/UpdateProgramItemModal";
    import API from "../../../Api";

    export default {
        name: 'Program',
        props: ['program'],
        components: {
            CreateProgramItemModal,
            UpdateProgramItemModal,
            TitleDisplay,
            Item,
        },
        data() {
            return {
                createProgramItemModal: false,
                updateProgramItemModal: false,
                ItemId: null,
            }
        },
        methods: {
            async setModalState(state) {
                this[state] = !this[state];
                this.forceUpdate();
            },
            updateItem(id) {
                this.ItemId = id;
                this.setModalState('updateProgramItemModal')
            },
            forceUpdate() {

            },
            async deleteItem(id) {
                await API.delete('/api/program-item/' + id);
                this.forceUpdate();
            },
        },
        mounted() {
            console.log(this.program)
        },
    }
</script>
