<template>
    <div class="admin-display-page">
        <div class="admin-display-page-main">
            <div class="admin-display-page-main-title">titel</div>
            <div class="admin-display-page-main-container">

            </div>
        </div>
        <div class="admin-item-container-footer"></div>
    </div>
</template>

<script>
    import API from "../../../Api";

    export default {
        name: 'Rolls',
        data() {
            return {
                rolls: [],
            }
        },
        methods: {

        },
        async mounted() {
            const res = await API.get('api/role');
            console.log(res);
        }
    }
</script>

