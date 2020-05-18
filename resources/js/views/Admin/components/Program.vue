<template>
    <div>
        <h1>{{program.name}}</h1>
    </div>
</template>

<script>

    export default {
        name: 'Program',
        props: ['program'],
        data() {
            return {

            }
        },
        mounted() {
            console.log(this.program);
        },
    }
</script>

<style>

</style>
