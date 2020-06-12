<template>
    <div class="full-page-form">
        <div class="form-holder">
            <div class="form-errors" v-if="errors.length">
                <p>Fout:</p>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>
            <form class="form" autocomplete="off" @submit.prevent="requestRegister">
                <h2 class="form-title">
                    Register Account
                </h2>

                <div class="form-line form-loading" v-if="isLoading">
                    <loading></loading>
                </div>

                <div class="form-line">
                    <label class="form-label" for="name">Naam</label>
                    <input class="form-text-input" type="text" v-model="name">
                </div>
                <div class="form-line">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-text-input" type="text" v-model="email" required>
                </div>
                <div class="form-line">
                    <label class="form-label" for="password">Wachtwoord</label>
                    <input class="form-text-input" type="password" v-model="password">
                </div>
                <div class="form-line">
                    <label class="form-label" for="password_confirmation">Bevestig Wachtwoord</label>
                    <input class="form-text-input" type="password"
                           v-model="password_confirmation">
                </div>
                <div class="form-line">
                    <label class="form-label" for="role">Soort Bezoeker</label>
                    <select class="form-text-input" id="role" v-model="role">
                        <option v-for="userrole in roles" :value="userrole.id">{{userrole.role_name}}</option>
                    </select>
                </div>
                <div class="form-line">
                    <input type="checkbox" v-model="terms" />
                    <label class="form-label" for="terms">Algemene voorwaarden</label>
                </div>
                <div class="form-line form-line-hasbutton">
                    <input type="submit" class="form-button" value="registreer account">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import loading from '@/js/components/loading'

    export default {
        name: "Registration",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                role: null,
                terms: false,
                errors: [],
                isLoading: false,
                roles:[]
            }
        },
        components: {loading},
        methods: {
            async requestRegister() {
                    this.isLoading = true;
                    axios.post("/api/register",
                        {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation,
                            role_id: this.role,
                            terms: this.terms
                        }).then(result => {
                            console.log(result.data)
                            this.isLoading = false;
                            this.message = result.data.message;
                        }, error => {
                            this.errors.push(error)
                        });
            }
        },
        mounted(){
            axios
                .get('/api/selectable-roles')
                .then(response => (this.roles = response.data))
            console.log(this.roles)
        }
    }
</script>

<style scoped>

</style>
