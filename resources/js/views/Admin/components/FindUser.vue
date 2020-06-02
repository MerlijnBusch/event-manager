<template>
    <div class="admin-display-page">
        <div class="admin-display-page-main">
            <form class="form admin-form-find-user" @submit.prevent="checkForm" method="post">

                <div class="form-line admin-form-find-user-input">
                    <input class="form-text-input" id="search" v-model="search" type="text" name="search"
                           placeholder="Search profile">
                </div>

                <div class="admin-from-submit">
                    <input type="submit" value="Submit" class="submit-btn admin-form-submit">
                </div>

            </form>
            <div class="admin-display-page-main-container">
                <div class="admin-find-user-display-table">
                    <div class="admin-find-user-table-cell">Naam</div>
                    <div class="admin-find-user-table-cell">Email</div>
                    <div class="admin-find-user-table-cell">Rol</div>
                    <div class="admin-find-user-table-cell-actions"></div>
                </div>
                <div v-for="user in users" class="admin-find-user-display-table">
                    <div class="admin-find-user-table-cell">{{user.name}}</div>
                    <div class="admin-find-user-table-cell">{{user.email}}</div>
                    <div class="admin-find-user-table-cell">{{user.role.role_name}}</div>
                    <div class="admin-find-user-table-cell-actions">
                        <div class="">
                            <i class="fas fa-pencil"></i>
                        </div>
                        <div class="">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
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

                const response = await API.post(data, '/api/admin/search');
                this.users = response.data.message;
                console.log(this.users)

                e.preventDefault();
            }
        },
    };
</script>
