<template>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="admin-sidebar-event-container">

            </div>
        </div>
        <div class="admin-main">
            <div class="admin-event-container">
                <h1>test</h1>
            </div>
            <div class="admin-program-container">

            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";

    export default {
        name: 'Role-Form',
        data() {
            return {
                events: [],
            }
        },
        async mounted() {
            const data = await API.get('/api/admin');
            console.log(data, 'test');

        },
    }
</script>

<style>
    .admin-container {

    }

    .admin-sidebar {

    }

    .admin-sidebar-event-container {

    }

    .admin-main {

    }

    .admin-event-container {

    }

    .admin-program-container {

    }
</style>
