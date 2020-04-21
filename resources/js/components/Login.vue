<template>
    <div>
        <br><br><br><br><br><br>
        <button @click="close">Close modal bla bla bla</button>
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

            <p>
                <label for="email">email</label>
                <input
                        id="email"
                        v-model="email"
                        type="email"
                        name="email"
                >
            </p>

            <p>
                <label for="password">password</label>
                <input
                        id="password"
                        v-model="password"
                        type="password"
                        name="password"
                >
            </p>

            <p>
                <input
                        type="submit"
                        value="Submit"
                >
            </p>

        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                errors: [],
                //TODO: remove this later
                email: 'Admin@example.com',
                password: 'password',
            }
        },
        methods: {
            close(){
                this.$emit("close");
            },
            checkForm: function (e) {
                this.errors = [];

                if (this.email && this.password) {
                    axios.post(window.location.origin + `/api/login`, {
                        "email": this.email,
                        "password": this.password,
                    }).then(response => {
                        if (response.status === 200){
                            this.$emit("loggedIn", response.request.response);
                            this.close()
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