<template>
    <div class="full-page-form">
        <div class="form-holder">
        <form class="form" autocomplete="off" @submit.prevent="resetPassword" method="post">
            <h2 class="form-title">Reset your password</h2>
            <div class="form-line">
                <label class="form-label" for="email">E-mail</label>
                <input type="email" id="email" class="form-text-input" v-model="email" required>
            </div>
            <div class="form-line">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" class="form-text-input" v-model="password" required>
            </div>
            <div class="form-line">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" class="form-text-input" v-model="password_confirmation" required>
            </div>

            <div class="form-line">
                <input type="submit" class="form-button" value="Update">
            </div>
        </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: this.$route.params.token,
                email: null,
                password: null,
                password_confirmation: null,
                has_error: false
            }
        },
        methods: {
            resetPassword() {
                    axios.post("/api/reset/password/", {
                    token: this.token,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(result => {
                         console.log(result.data);
                        this.$router.push({name: 'login'})
                    }, error => {
                        console.error(error);
                    });
            }
        }
    }
</script>
