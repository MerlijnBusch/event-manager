<template>
    <div>
        test
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: "VerifyEmail",
        data() {
            verify: false
            return{}
        },
        mounted() {
            axios
                .patch('/api/email/verify', {
                    token: this.$route.params.token
                })
                .then(response => {

                })
        }
    }
</script>
