<template>
    <div class="admin-main-program-title">
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
