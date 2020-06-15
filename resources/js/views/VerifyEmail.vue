<template>
    <div>
        <h2>Account Verificatie</h2>
        <p>{{message}}</p>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: "VerifyEmail",
        data() {
            return {
                verify: false,
                message: ''
            }
        },
        mounted() {
            axios
                .patch('/api/email/verify', {
                    token: this.$route.params.token
                })
                .then(response => {
                    console.log(response);
                    this.message = response.data;
                }).catch(e => {
                    if (e.response.status == 422) {
                        this.message = e.response.data.message;
                    }
                })
        }
    }
</script>
