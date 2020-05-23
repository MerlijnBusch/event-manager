<template>
    <div class="admin-main-program-title">
        {{program.name}}
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
