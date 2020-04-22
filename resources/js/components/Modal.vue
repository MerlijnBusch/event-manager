<template>
    <div>
        <button @click="close" class="login-close"><div><div></div></div></button>
        <div>
            <login v-if="selectroute==='login'"></login>
            <forgot-password v-else-if="selectroute==='ForgotPassword'"></forgot-password>
        </div>
        <div>
            <button @click="selectroute='login'" v-if="selectroute!=='login'">Login</button>
            <button @click="selectroute='ForgotPassword'" v-if="selectroute!=='ForgotPassword'">Forgot Password</button>
        </div>
    </div>
</template>

<script>
    import login from "./Login"
    import ForgotPassword from "./ForgotPassword"

    export default {
        name: "Modal",
        data(){
            return {
                selectroute: "login"

            }
        },
        components: {login,ForgotPassword},
        methods:{
            close(){
                this.$emit("close");
            }
        }
    }


</script>
