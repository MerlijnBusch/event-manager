<template>
    <form
        id="app"
        @submit.prevent="checkForm"
        method="post"
    >

        <div v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

        <h2 class="form-title">
            Event Settings
        </h2>
        <p>
            <label class="form-label" for="visible_registrations">Visible registrations</label>
            <input
                class="text-input"
                id="visible_registrations"
                v-model="visible_registrations"
                type="number"
                name="visible_registrations"
                placeholder="Visible registration"
            >
        </p>
        <p>
            <label class="form-label" for="max_registrations">Max registrations</label>
            <input
                class="text-input"
                id="max_registrations"
                v-model="max_registrations"
                type="number"
                name="max_registrations"
                placeholder="Max registration"
            >
        </p>
        <p>
            <label class="form-label" for="primary_color">Primary color</label>
            <input
                class="text-input"
                id="primary_color"
                v-model="primary_color"
                type="color"
                name="primary_color"
            >
        </p>
        <p>
            <label class="form-label" for="secondary_color">Secondary color</label>
            <input
                class="text-input"
                id="secondary_color"
                v-model="secondary_color"
                type="color"
                name="secondary_color"
            >
        </p>
        <p>
            <label class="form-label" for="active">Active</label>
            <input
                class="text-input"
                id="active"
                v-model="active"
                type="checkbox"
                name="active"
            >
        </p>
        <p>
            <input
                type="submit"
                value="Submit"
                class="submit-btn"
            >
        </p>
    </form>
</template>

<script>
    import API from "../../Api";

    export default {
        data() {
            return {
                errors: [],
                event_id: this.$route.params.event_id,
                visible_registrations: null,
                max_registrations: null,
                primary_color: '',
                secondary_color: '',
                active: false,
            }
        },
        methods: {
            checkForm: function (e) {

                this.errors = [];

                const data = {
                    "event_id": this.event_id,
                    "visible_registrations": this.visible_registrations,
                    "max_registrations": this.max_registrations,
                    "primary_color": this.primary_color,
                    "secondary_color": this.secondary_color,
                    "active": this.active,
                }

                API.post(data, '/api/event-settings');

                e.preventDefault();
            }
        }
    }
</script>
