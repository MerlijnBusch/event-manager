<template>
    <form
        class="form"
        autocomplete="off"
        @submit.prevent="requestResetPassword"
    >
        <h2 class="form-title">
            Wachtwoord vergeten
        </h2>

        <div
            v-if="isLoading"
            class="form-line form-loading"
        >
            <loading />
        </div>

        <div
            v-if="errors.length"
            class="form-errors"
        >
            <p>Fout:</p>
            <ul>
                <li
                    v-for="error in errors"
                    :key="error"
                >
                    {{ error }}
                </li>
            </ul>
        </div>

        <div
            v-if="!!message"
            class="form-message"
        >
            {{ message }}
        </div>

        <div class="form-line">
            <label
                class="form-label"
                for="email"
            >E-mail</label>
            <input
                id="email"
                v-model="email"
                class="form-text-input"
                type="text"
            >
            <button
                class="form-afterinput-link"
                @click="$emit('login')"
            >
                Ik heb al een account
            </button>
        </div>
        <div class="form-line form-line-hasbutton">
            <input
                type="submit"
                class="form-button"
                value="Stuur wachtwoord reset link"
            >
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import loading from '@/js/components/loading';

export default {
    name: 'ForgotPassword',
    data () {
        return {
            email: 'Admin@example.com',
            message: null,
            isLoading: false,
            errors: []
        };
    },
    components: { loading },
    methods: {
        requestResetPassword () {
            this.errors = [];
            this.isLoading = true;

            switch (true) {
            case this.email.length === 0:
                this.isLoading = false;
                this.errors.push('Er is niks ingevuld');
                break;
            case /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$ {2}/.test(this.email) === false:
                this.isLoading = false;
                this.errors.push('Er is geen email ingevuld');
                break;
            default:
                axios.post('/api/reset-password', { email: this.email }).then(result => {
                    this.message = result.data.message;
                    this.isLoading = false;
                }, error => {
                    this.errors.push(error);
                });
            }
        }
    }
};
</script>
