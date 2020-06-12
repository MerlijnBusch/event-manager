<template>
    <div>
        test
    </div>
</template>

<script>
    export default {
        name: "VerifyEmail",
        data(){
            return{}
        },
        mounted(){
            console.log(this.$route.params.token);
        }
    }
</script>
