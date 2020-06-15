<template>
    <div class="full-page-form">
        <div class="form-holder">
            <form
                class="form"
                autocomplete="off"
                method="post"
                @submit.prevent="resetPassword"
            >
                <h2 class="form-title">
                    Reset your password
                </h2>
                <div class="form-line">
                    <label
                        class="form-label"
                        for="email"
                    >E-mail</label>
                    <input
                        id="email"
                        v-model="email"
                        type="email"
                        class="form-text-input"
                        required
                    >
                </div>
                <div class="form-line">
                    <label
                        class="form-label"
                        for="password"
                    >Password</label>
                    <input
                        id="password"
                        v-model="password"
                        type="password"
                        class="form-text-input"
                        required
                    >
                </div>
                <div class="form-line">
                    <label
                        class="form-label"
                        for="password_confirmation"
                    >Confirm Password</label>
                    <input
                        id="password_confirmation"
                        v-model="password_confirmation"
                        type="password"
                        class="form-text-input"
                        required
                    >
                </div>

                <div class="form-line form-line-hasbutton">
                    <input
                        type="submit"
                        class="form-button"
                        value="Update"
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data () {
        return {
            token: this.$route.params.token,
            email: null,
            password: null,
            password_confirmation: null,
            has_error: false
        };
    },
    methods: {
        resetPassword () {
            axios.post('/api/reset/password/', {
                token: this.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(result => {
                    this.$router.push({ name: 'login' });
                }, error => {
                    console.error(error);
                });
        }
    }
};
</script>
