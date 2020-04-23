<template>
    <form autocomplete="off" @submit.prevent="requestResetPassword" method="post" class="form-forgot-pass">
        <h1>Forgot Password</h1>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
        </div>
        <input type="submit" class="btn btn-primary btn-pass-reset" value="Send Password Reset Link">
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "ForgotPassword",
        data() {
            return {
                email: 'user@example.com',
                has_error: false
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/api/reset-password", {email: this.email}).then(result => {
                    this.response = result.data;
                    console.log(result.data);
                }, error => {
                    console.error(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
