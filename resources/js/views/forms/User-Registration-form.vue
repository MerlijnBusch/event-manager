<template>
    <div class="full-page-form">
        <div class="form-holder">
            <form class="form" autocomplete="off" @submit.prevent="requestRegister">
                <h2 class="form-title">
                    Register Account
                </h2>

                <div class="form-line form-loading" v-if="isLoading">
                    <loading></loading>
                </div>

                <div class="form-errors" v-if="errors.length">
                    <p>Fout:</p>
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="form-message" v-if="!!message">
                    {{message}}
                </div>

                <div class="form-line">
                    <label class="form-label" for="name">Naam</label>
                    <input class="form-text-input" type="text" id="name" v-model="name">
                </div>
                <div class="form-line">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-text-input" type="text" id="email" v-model="email" required>
                </div>
                <div class="form-line">
                    <label class="form-label" for="password">Wachtwoord</label>
                    <input class="form-text-input" type="password" id="password" v-model="password">
                </div>
                <div class="form-line">
                    <label class="form-label" for="password_confirmation">Bevestig Wachtwoord</label>
                    <input class="form-text-input" type="password" id="password_confirmation"
                           v-model="password_confirmation">
                </div>
                <div class="form-line">
                    <label class="form-label" for="role">Soort Bezoeker</label>
                    <select class="form-text-input" id="role" v-model="role">
                        <option v-for="userrole in roles" :value="userrole.id">{{userrole.role_name}}</option>                  
                    </select>
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
    import dropdown from "@/js/components/dropdown";

    export default {
        name: "Registration",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                role: null,
                message: null,
                isLoading: false,
                errors: [],
                roles:[]
            }
        },
        components: {loading, dropdown},
        methods: {
            requestRegister() {
                this.errors = [];
                this.isLoading = true;

                switch (true) {
                    case this.email.length === 0:
                        this.isLoading = false;
                        this.errors.push('Er is niks ingevuld');
                        break;
                    // case /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$  /.test(this.email) === false:
                    //     this.isLoading = false;
                    //     this.errors.push('Er is geen email ingevuld');
                    //     break;
                    case /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} /.test(this.password) === false:
                        this.isLoading = false;
                        this.errors.push('Het wachtwoord is incorrect. Gebruik minimaal 8 karakters, een hoofdletter en een nummer.');
                    default:
                        axios.post("/register", {email: this.email}).then(result => {
                            this.message = result.data.message;
                            this.isLoading = false;
                        }, error => {
                            this.errors.push(error)
                        });
                }
            },
        },
        mounted(){
            axios
                .get('/api/selectable-roles')
                .then(response => (this.roles = response.data))
        }
    }
</script>

<style scoped>

</style>
