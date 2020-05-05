<template>
    <form class="form" autocomplete="off" @submit="requestResetPassword" method="post">
        <h2 class="form-title">
            Wachtwoord vergeten
        </h2>

        <div class="form-line form-loading" v-if="isLoading">
            <loading></loading>
        </div>

        <div class="form-errors" v-if="errors.length">
            <p>Please correct the following error(s):</p>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

        <div class="form-line">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-text-input" type="email" id="email" v-model="email" required>
            <button class="form-afterinput-link" @click="$emit('login')">Ik heb al een account</button>
        </div>
        <div class="form-line form-line-hasbutton">
            <input type="submit" class="form-button" value="Stuur wachtwoord reset link">
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    import loading from './loading'

    export default {
        name: "ForgotPassword",
        data() {
            return {
                email: 'Admin@example.com',
                has_error: false,
                message: null,
                isLoading: false,
            }
        },
        components: {loading},
        methods: {
            requestResetPassword() {
                this.isLoading = true;
                axios.post("/api/reset-password", {email: this.email}).then(result => {
                    this.message = result.data.message;
                    this.isLoading = false;
                }, error => {
                    console.error(error);
                });
            }
        }
    }
</script>
