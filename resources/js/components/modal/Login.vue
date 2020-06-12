<template>
    <form class="form" id="app" @submit="checkForm" method="post">
        <h2 class="form-title">
            Login
        </h2>


        <div class="form-line">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-text-input" id="email" v-model="email" type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-line">
            <label class="form-label" for="password">Wachtwoord</label>
            <input class="form-text-input" id="password" v-model="password" type="password" name="password"
                   placeholder="Password" required>
            <button class="form-afterinput-link" type="button" @click="$emit('forgotpassword')">Wachtwoord vergeten</button>
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
                //TODO: remove this later
                email: 'amin_robleh@live.nl',
                password: 'Testpassword1',
            }
        },
        methods: {
            checkForm: function (e) {

                    axios.post(window.location.origin + `/api/login`, {
                        "email": this.email,
                        "password": this.password,
                    }).then(response => {
                            this.$user.data = JSON.parse(response.request.response);
                            API.setToken(this.$user.data.data.api_token);
                            this.$emit("loggedIn", response.request.response);
                            this.$emit("close");
                    }).catch((e) => {
                        if (e.response.status == 403) {
                            this.$emit("openAccountVerification");
                        } else {
                             API.errorCheck(e);
                        }

                       
                    })

                e.preventDefault();
            }
        }
    }
</script>
