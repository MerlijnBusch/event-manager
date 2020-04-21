<template>
    <div>
        <div class="navbar">
            <div class="navbar-inner">
                <img class="navbar-logo" src="/img/nz-logo-light.png">
                <button class="navbar-hamburger" @click="hamburger = false">{{hamburger}}</button>
            </div>
        </div>
        <div class="sidenav" :class="{'sidenav-hidden' : hamburger}">
            <button class="sidenav-close" @click="hamburger = true">close</button>
            <router-link to="/" exact>home</router-link>
            <router-link to="/about">about</router-link>
            <button @click="modal_login_open = true">Login</button>
        </div>
        <login v-if="modal_login_open" @close="closeLogin"></login>
        <div class="main">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import login from '../components/Login.vue'

    export default {
        data() {
            return {
                hamburger: true,
                modal_login_open: false,
            }
        },
        methods:{
          closeLogin(){
              this.modal_login_open = false;
          }
        },
        components: {login},
    }
</script>
