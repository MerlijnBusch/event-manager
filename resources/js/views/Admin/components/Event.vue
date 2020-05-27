<template>
    <div class="admin-event-container">
        <input class="admin-event-title-input" id="name" v-model="event.name" type="text" name="name"
               placeholder="Event name"/>
    </div>
</template>

<script>
    import API from "@/js/Api";

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
