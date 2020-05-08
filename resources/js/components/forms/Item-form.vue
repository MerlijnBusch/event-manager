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
            <label class="form-label" for="name">Name</label>
            <input
                class="text-input"
                id="name"
                v-model="name"
                type="number"
                name="name"
                placeholder="Item name"
            >
        </p>
        <p>
            <label class="form-label" for="type">type</label>
            <select v-model="type" id="type" name="type" class="text-input">
                <option disabled value="">Please select one</option>
                <option value="congress_speakers">Congress speakers</option>
                <option value="keynotes">Key notes</option>
            </select>
        </p>
        <p>
            <label class="form-label" for="description">Description</label>
            <textarea
                class="text-input"
                id="description"
                v-model="description"
                type="description"
                name="description"
                placeholder="Event description"
            ></textarea>
        </p>
        <p>
            <label class="form-label" for="date">Date</label>
            <input
                class="text-input"
                id="date"
                v-model="date"
                type="date"
                name="date"
                placeholder="Event date"
            />
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
    import axios from 'axios';

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

                const headers = {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$user.data.api_token
                }

                const data = {
                    "event_id": this.event_id,
                    "name": this.name,
                    "type": this.type,
                    "description": this.description,
                    "date": this.date,
                }
                axios.post(window.location.origin + `/api/item`, data, {headers: headers}).then(response => {
                    if (response.status === 200) {
                        console.log('success', response)
                    }
                }).catch(e => {
                    this.errors.push(e)
                })

                e.preventDefault();
            }
        }
    }
</script>
