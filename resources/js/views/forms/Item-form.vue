<template>
    <div class="full-page-form">
        <div class="form-holder">
            <form
                class="form"
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
                <div class="form-line">
                    <label class="form-label" for="name">Name</label>
                    <input
                        class="form-text-input"
                        id="name"
                        v-model="name"
                        type="number"
                        name="name"
                        placeholder="Item name"
                    >
                </div>
                <div class="form-line">
                    <label class="form-label" for="type">type</label>
                    <select v-model="type" id="type" name="type" class="form-text-input">
                        <option disabled value="">Please select one</option>
                        <option value="congress_speakers">Congress speakers</option>
                        <option value="keynotes">Key notes</option>
                    </select>
                </div>
                <div class="form-line">
                    <label class="form-label" for="description">Description</label>
                    <textarea
                        class="form-text-input"
                        id="description"
                        v-model="description"
                        type="description"
                        name="description"
                        placeholder="Event description"
                    ></textarea>
                </div>
                <div class="form-line">
                    <label class="form-label" for="date">Date</label>
                    <input
                        class="form-text-input"
                        id="date"
                        v-model="date"
                        type="date"
                        name="date"
                        placeholder="Event date"
                    />
                </div>
                <div class="form-line">
                    <input
                        type="submit"
                        value="Submit"
                        class="submit-btn"
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import API from "../../Api";

    export default {
        data() {
            return {
                errors: [],
                event_id: this.$route.params.event_id,
                name: null,
                type: null,
                description: '',
                date: '',
            }
        },
        methods: {
            checkForm: function (e) {

                this.errors = [];

                const data = {
                    "event_id": this.event_id,
                    "name": this.name,
                    "type": this.type,
                    "description": this.description,
                    "date": this.date,
                }

                API.post(data, '/api/item');

                e.preventDefault();
            }
        }
    }
</script>
