<template>
    <h1>Forgot Password</h1>
</template>
    <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
<script>
    export default {
        name: "ForgotPassword",
        data() {
            return {
                email: null,
                has_error: false
            }
        },
        methods: {
            requestResetPassword() {
                this.$http.post("/reset-password", {email: this.email}).then(result => {
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
