<template>
    <form autocomplete="off" @submit.prevent="requestResetPassword" method="post" class="form-forgot-pass">
        <h1>Wachtwoord vergeten</h1>
        <div class="form-group">
            <div class="form-forgot-returnmessage" v-if="message !== null">
                {{message}}
            </div>
            <p class="forgot-email-label"><label for="email">E-mail</label></p>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            <p class="form-forgot-pass-account">
                <button class="form-forgot-pass-account-button" @click="$emit('login')">Ik heb al een account</button>
            </p>
        </div>
        <input type="submit" class="btn btn-primary btn-pass-reset" value="Stuur wachtwoord reset link">
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "ForgotPassword",
        data() {
            return {
                email: 'user@example.com',
                has_error: false,
                message: null,
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/api/reset-password", {email: this.email}).then(result => {
                    this.message = result.data.message
                }, error => {
                    console.error(error);
                });
            }
        }
    }
</script>
