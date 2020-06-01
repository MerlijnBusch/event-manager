<template>
    <form class="form" id="app" @submit="checkForm" method="post">
        <h2 class="form-title">
            Login
        </h2>

        <div class="form-errors" v-if="errors.length">
            <p>Fout:</p>
            <ul>
                <li :key=(index) v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </div>

        <div class="form-line">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-text-input" id="email" v-model="email" type="email" name="email" placeholder="Email">
        </div>

        <div class="form-line">
            <label class="form-label" for="password">Wachtwoord</label>
            <input class="form-text-input" id="password" v-model="password" type="password" name="password"
                   placeholder="Password">
            <button class="form-afterinput-link" @click="$emit('forgotpassword')">Wachtwoord vergeten</button>
        </div>
        <div class="form-line form-line-hasbutton">
            <input type="submit" value="Login" class="form-button">
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    import API from '../../Api';

    export default {
        data() {
            return {
                errors: [],
                //TODO: remove this later
                email: 'Admin@example.com',
                password: 'password',
            }
        },
        methods: {
            checkForm: function (e) {
                this.errors = [];

                if (this.email && this.password) {
                    axios.post(window.location.origin + `/api/login`, {
                        "email": this.email,
                        "password": this.password,
                    }).then(response => {
                        if (response.status === 200 && response.data.data) {
                            this.$user.data = JSON.parse(response.request.response);
                            API.setToken(this.$user.data.data.api_token);
                            this.$emit("loggedIn", response.request.response);
                            this.$emit("close");
                        }
                    })
                        .catch(e => {
                            this.errors.push(e)
                        })
                }

                if (!this.email) {
                    this.errors.push('email required.');
                }
                if (!this.password) {
                    this.errors.push('password required.');
                }

                e.preventDefault();
            }
        }
    }
</script>
