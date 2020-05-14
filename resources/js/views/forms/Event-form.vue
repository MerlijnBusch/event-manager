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
                    Event
                </h2>

                <div class="form-line">
                    <label class="form-label" for="name">Name</label>
                    <input
                        class="form-text-input"
                        id="name"
                        v-model="name"
                        type="text"
                        name="name"
                        placeholder="Event name"
                    >
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
                name: '',
                description: '',
                date: new Date()
            }
        },
        methods: {
            checkForm: function (e) {

                this.errors = [];

                const data = {
                    "name": this.name,
                    "description": this.description,
                    "date": this.date,
                }

                API.post(data, '/api/event')

                e.preventDefault();
            }
        }
    }
</script>
