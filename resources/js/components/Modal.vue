<template>
    <div class="modal_holder">
        <div class="modal_screen column-desktop-4 column-tablet-9 column-mobile-12">
            <button @click="close" class="login-close">
                <div>
                    <div></div>
                </div>
            </button>
            <div>
                <login @close="close" @loggedIn="loggedInHandler" v-if="selectroute==='login'"></login>
                <forgot-password v-else-if="selectroute==='ForgotPassword'"></forgot-password>
            </div>
            <div class="btn-forgot-pass">
                <button @click="selectroute='login'" v-if="selectroute!=='login'">Login</button>
                <button @click="selectroute='ForgotPassword'" v-if="selectroute!=='ForgotPassword'">Wachtwoord vergeten
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import login from "./Login"
    import ForgotPassword from "./ForgotPassword"

    export default {
        name: "Modal",
        data() {
            return {
                selectroute: "login"

            }
        },
        components: {login, ForgotPassword},
        methods: {
            close() {
                this.$emit("close");
            },
            loggedInHandler (e){
                this.$emit("loggedIn", e);
            },
        }
    }


</script>
