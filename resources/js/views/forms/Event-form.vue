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

        <h2 class="login-title">
            Event
        </h2>

        <p>
            <label class="login-label" for="name">Name</label>
            <input
                class="text-input"
                id="name"
                v-model="name"
                type="text"
                name="name"
                placeholder="Event name"
            >
        </p>

        <p>
            <label class="login-label" for="description">Description</label>
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
            <label class="login-label" for="date">Date</label>
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
                name: '',
                description: '',
                date: new Date()
            }
        },
        methods: {
            checkForm: function (e) {

                this.errors = [];

                this.headers = {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$user.data.api_token
                }

                this.date = {
                    "name": this.name,
                    "description": this.description,
                    "date": this.date,
                }
                console.log(this.$user, this.$user.data.api_token);
                if (this.name && this.description) {
                    axios.post(window.location.origin + `/api/event`, this.data, {headers: this.headers}).then(response => {
                        if (response.status === 200) {
                            console.log('success', response)
                        }
                    }).catch(e => {
                        this.errors.push(e)
                    })
                }

                if (!this.name) {
                    this.errors.push('name required.');
                }
                if (!this.description) {
                    this.errors.push('description required.');
                }

                e.preventDefault();
            }
        }
    }
</script>
