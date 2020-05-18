<template>
    <div class="admin-event-container">
        <h1>{{item.name}}</h1>
    </div>
</template>

<script>

    export default {
        name: 'Item',
        props: ['item'],
        data() {
            return {

            }
        },
        mounted() {
            console.log(this.item);
        },
    }
</script>

<style>

</style>
