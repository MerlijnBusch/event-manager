<template>
    <form
            id="app"
            @submit="checkForm"
            method="post"
    >

        <div v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

        <h2 class="login-title">
            Login
        </h2>

        <p>
            <label class="login-label" for="email">E-mail</label>
            <input
                    class="text-input"
                    id="email"
                    v-model="email"
                    type="email"
                    name="email"
                    placeholder="Email"
            >
        </p>

        <p>
            <label class="login-label" for="password">Wachtwoord</label>
            <input
                    class="text-input"
                    id="password"
                    v-model="password"
                    type="password"
                    name="password"
                    placeholder="Password"
            >
        </p>
        <p class="login-forgotpassword">
            <button @click="$emit('forgotpassword')">Wachtwoord vergeten</button>
        </p>
        <p>
            <input
                    type="submit"
                    value="Login"
                    class="submit-btn"
            >
        </p>
    </form>
</template>

<script>
    import axios from 'axios';

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

                window.addEventListener("loggedIn", (e) => {
                    console.log(e);
                });

                if (this.email && this.password) {
                    axios.post(window.location.origin + `/api/login`, {
                        "email": this.email,
                        "password": this.password,
                    }).then(response => {
                        if (response.status === 200) {
                            this.$user.data = JSON.parse(response.request.response);
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
