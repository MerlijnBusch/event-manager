<template>
    <div class="admin-event-container">
        <input class="admin-event-title-input" id="name" v-model="event.name" type="text" name="name"
               placeholder="Event name"/>
        <quill class="admin-text-editor" output="html" v-model="event.description" :config="config"></quill>
    </div>
</template>

<script>
    import API from "@/js/Api";
    import {Config} from "../../../quillConfig";

    export default {
        name: 'Event',
        props: ['event'],
        data() {
            return {
                config: Config,
            }
        },
        mounted() {
            console.log(this.event);
        },
    }
</script>

<style>
    .admin-event-container {
        margin-top: 4px;
    }

    .admin-text-editor {
        margin-top: 8px;
    }

    .ql-editor {
        max-height: 200px !important;
    }

    .admin-event-title-input {
        background: transparent;
        outline: transparent;
        border: transparent;
        width: 100%;
        font-size: xx-large;
    }

    .admin-event-title-input:focus {
        border-bottom: 2px solid lightblue;
    }
</style>
