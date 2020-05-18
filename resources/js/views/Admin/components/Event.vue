<template>
    <div class="admin-event-container">
        <input class="admin-event-title-input" id="name" v-model="event.name" type="text" name="name"
               placeholder="Event name"/>
        <quill class="admin-text-editor" output="html" v-model="event.description" :config="config"></quill>
        <div class="admin-event-date-active">
            <div>
                <label for="date_start">start date</label>
                <input type="date" name="date_start" id="date_start" v-model="event.date_start">
                <label for="date_end">end date</label>
                <input type="date" name="date_end" id="date_end" v-model="event.date_end">
            </div>
            <div>
                <label for="active">active</label>
                <input type="checkbox" name="active" id="active" v-model="event.active">
            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";

    const toolbar = [
        ['bold', 'italic', 'underline', 'strike'], ['blockquote', 'code-block'], [{'header': 1}, {'header': 2}],
        [{'list': 'ordered'}, {'list': 'bullet'}], [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}], [{'direction': 'rtl'}], [{'size': ['small', false, 'large', 'huge']}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}], [{'color': []}, {'background': []}], [{'font': []}],
        [{'align': []}], ['clean']
    ];

    export default {
        name: 'Event',
        props: ['event'],
        data() {
            return {
                config: {
                    readOnly: false,
                    placeholder: 'Compose an epic...',
                    modules: {
                        toolbar: toolbar
                    },
                },
            }
        },
        mounted() {
            console.log(this.event);
        },
    }
</script>

<style>
    .admin-event-container {
        padding: 16px;
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

    .admin-event-date-active {
        margin-top: 8px;
        display: flex;
        justify-content: space-between;
        align-content: center;
    }
</style>
