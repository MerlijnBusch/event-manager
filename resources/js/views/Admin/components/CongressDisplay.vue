<template>
    <div class="admin-main-program-container">
        <TitleDisplay v-bind:display="congress"></TitleDisplay>
        <div class="admin-item-container">
            <div class="admin-item-list">
                <div class="admin-block-list">
                    <div v-for="block in congress.block" class="admin-block-list-holder">
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
                <div v-for="block in congress.block" class="admin-item-display-container-for">
                    <div v-for="item in block.items">
                        <item v-bind:item="item"></item>
                        <div class="admin-item-hr"></div>
                    </div>
                </div>
            </div>
            <div class="admin-item-container-line"></div>
        </div>

        <create-block-modal
            v-show="createBlockModal"
            v-bind:id="congress.id"
            @close="setModalState(`createBlockModal`)"
        />

        <update-block-modal
            v-if="updateBlockId"
            v-bind:id="updateBlockId"
            v-show="updateBlockModal"
            @close="setModalState(`updateBlockModal`)"
        />

        <create-item-modal
            v-if="blockId"
            v-show="createItemModal"
            v-bind:id="blockId"
            @close="setModalState(`createItemModal`)"
        />


    </div>
</template>

<script>
    import TitleDisplay from "./TitleDisplay";
    import Item from "./Item";
    import CreateBlockModal from "./modal/Create/CreateBlockModal";
    import API from "../../../Api";
    import UpdateBlockModal from "./modal/Update/UpdateBlockModal";
    import CreateItemModal from "./modal/Create/CreateItemModal";


    export default {
        name: 'CongressDisplay',
        components: {
            TitleDisplay,
            CreateBlockModal,
            UpdateBlockModal,
            CreateItemModal,
            Item,
        },
        props: ['congress'],
        data() {
            return {
                createBlockModal: false,
                updateBlockModal: false,
                createItemModal: false,
                blockId: null,
                updateBlockId: null,
            }
        },
        methods: {
            async setModalState(state) {
                this[state] = !this[state];
                this.forceUpdate();
            },
            async deleteBlock(id) {
                await API.delete('/api/block/' + id);
                this.forceUpdate();
            },
            displayBlockItems(id, amount) {
                let target = document.getElementById('block-items-' + id)
                let height = target.getBoundingClientRect().height;
                if (height === 0) target.style.height = (60 * amount) + "px";
                else target.style.height = "0px";
            },
            displayBlockActions(id) {
                let target = document.getElementById('block-' + id)
                let width = target.getBoundingClientRect().width;
                if (width === 0) target.style.width = "120px";
                else target.style.width = "0px";
            },
            addItemToBlock(id) {
                this.blockId = id;
                this.setModalState('createItemModal');
            },
            updateBlock(id) {
                this.updateBlockId = id;
                this.setModalState('updateBlockModal');
            },
            forceUpdate(){

            }
        },
        watch: {
            congress: async function(newVal, oldVal) {
                console.log(newVal, oldVal, this.congress, 'thiscongress')
            }
        },
        mounted() {
            console.log('this.congress', this.congress)
        },
    }
</script>
