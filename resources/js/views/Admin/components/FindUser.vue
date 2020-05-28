<template>
    <div class="admin-find-user">
        <div class="admin-find-user-main">
            <form class="form admin-form-find-user" @submit.prevent="checkForm" method="post">

                <div class="form-line admin-form-find-user-input">
                    <input class="form-text-input" id="search" v-model="search" type="text" name="search"
                           placeholder="Search profile">
                </div>

                <div class="admin-from-submit">
                    <input type="submit" value="Submit" class="submit-btn admin-form-submit">
                </div>

            </form>
            <div class="admin-found-user-container">
                <div v-for="user in users">
                    {{user.name}}
                </div>
            </div>
        </div>
        <div class="admin-item-container-footer"></div>
    </div>
</template>

<script>
    import API from "../../../Api";

    export default {
        data() {
            return {
                search: '',
                users: [],
            }
        },
        name: 'FindUser',
        methods: {
            async checkForm(e) {

                const data = {
                    search: this.search,
                };

                const response = await API.post(data, '/api/search/profile');
                this.users = response.data.message;


                e.preventDefault();
            }
        },
    };
</script>
