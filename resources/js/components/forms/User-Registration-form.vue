<template>
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
            <input class="form-text-input" type="email" id="email" v-model="email">
        </div>
        <div class="form-line">
            <label class="form-label" for="password">Wachtwoord</label>
            <input class="form-text-input" type="text" id="password" v-model="password">
        </div>
        <div class="form-line">
            <label class="form-label" for="password_confirmation">Bevestig Wachtwoord</label>
            <input class="form-text-input" type="text" id="password_confirmation" v-model="password_confirmation">
        </div>
        <div class="form-line">
            <label class="form-label" for="role">Soort Bezoeker</label>
            <input class="form-text-input" type="text" id="role" v-model="role">
        </div>
        <div class="form-line form-line-hasbutton">
            <input type="submit" class="form-button" value="registreer account">
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    import loading from '@/js/components/loading'

    export default {
        name: "Registration",
        data() {
            return {
                email: 'Admin@example.com',
                message: null,
                isLoading: false,
                errors: [],
            }
        },
        components: {loading},
        methods: {

        }

    }
</script>

<style scoped>

</style>
