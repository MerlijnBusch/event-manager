<template>
    <div class="admin-main-program-title-holder">
        <div class="admin-main-program-title">{{program.name}}</div>
        <div class="admin-main-program-icon"><i class="fas fa-ellipsis-v"></i></div>
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
        mounted() {},
    }
</script>
