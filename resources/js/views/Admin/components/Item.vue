<template>
    <div class="admin-item-display-holder">
        <input class="admin-item-title-input" id="name" v-model="item.name" type="text" name="name"
               placeholder="Event name"/>
        <quill class="admin-item-text-editor" output="html" v-model="item.description" :config="config"></quill>
    </div>
</template>

<script>
    import {Config} from "../../../quillConfig";

    export default {
        name: 'Item',
        props: ['item'],
        data() {
            return {
                config: Config,
            }
        },
        mounted() {
            console.log(this.item);
        },
    }
</script>

<style>
    .admin-item-display-holder {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .admin-item-text-editor {
        margin-top: 8px;
    }

    .ql-editor {
        max-height: 150px !important;
    }

    .admin-item-title-input {
        background: transparent;
        outline: transparent;
        border: transparent;
        width: 100%;
        font-size: xx-large;
    }

    .admin-item-title-input:focus {
        border-bottom: 2px solid lightblue;
    }
</style>
