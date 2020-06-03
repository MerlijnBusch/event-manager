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
                <div
                    v-for="user in users"
                    class="admin-find-user-display-table"
                    :id="'admin-user-' + user.id"
                >
                    <div class="admin-find-user-table-cell">{{user.name}}</div>
                    <div class="admin-find-user-table-cell">{{user.email}}</div>
                    <div class="admin-find-user-table-cell">{{user.role.role_name}}</div>
                    <div class="admin-find-user-table-cell-actions">
                        <div
                            class=""
                            v-on:click="updateUser(user.id)"
                        >
                            <i class="fas fa-pencil"></i>
                        </div>
                        <div
                            class=""
                            v-on:click="deleteUser(user.id)"
                        >
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-item-container-footer"></div>

        <update-user-modal
            v-if="user_id"
            v-bind:id="user_id"
            v-show="updateUserModal"
            @close="setModalState(`updateUserModal`)"
        />

    </div>
</template>

<script>
    import API from "../../../Api";
    import UpdateUserModal from "./modal/UpdateUserModal";

    export default {
        data() {
            return {
                search: '',
                users: [],
                updateUserModal: false,
                user_id: null
            }
        },
        components: {
            UpdateUserModal
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
            },
            updateUser(id) {
                this.user_id = id;
                this.setModalState(`updateUserModal`);
            },
            async deleteUser(id) {
                if (!confirm('Weet u zeker dat u deze user wilt verweideren')) return;
                await API.delete('/api/admin/user/' + id)
                let item = document.getElementById('admin-user-' + id);
                item.parentNode.removeChild(item);
            },
            async setModalState(state) {
                this[state] = !this[state];
            },
        },
    };
</script>
