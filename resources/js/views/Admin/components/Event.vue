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
