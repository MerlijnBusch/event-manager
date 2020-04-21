<template>
    <div>
        <NavBar @openLogin="openLogin" :loggedIn="loggedIn"></NavBar>
        <login v-if="modal_login_open" @loggedIn="loggedInHandler" @close="closeLogin"></login>
        <div class="main">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import NavBar from '../components/Navbar.vue'
    import login from '../components/Login.vue'

    export default {
        data() {
            return {
                loggedIn: false,
                modal_login_open: false,
            }
        },
        methods:{
            openLogin(){
                this.modal_login_open = true;
            },
          closeLogin(){
              this.modal_login_open = false;
          },
            loggedInHandler (e){
              this.loggedIn = true;
              console.log(e);
            },
        },
        components: {login, NavBar},
    }
</script>
