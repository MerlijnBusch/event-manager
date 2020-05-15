<template>
    <div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="navbar-user" v-if="loggedIn">
                    Welkom <span class="navbar-user-name">{{$user.data.name}}</span>!
                </div>
                <img class="navbar-logo" src="/img/nz-logo-light.png">
                <button class="navbar-hamburger" @click="siderbarIsOpen = true">
                    <div>
                        <div></div>
                    </div>
                </button>
            </div>
        </div>
        <div class="sidenav" :class="{'sidenav-hidden' : !siderbarIsOpen}">
            <button class="sidenav-close modal-close" @click="siderbarIsOpen = false">
                <div>
                    <div></div>
                </div>
            </button>
            <div class="sidenav-links">
                <router-link to="/" exact>Home</router-link>
                <router-link to="/about">About</router-link>
                <div class="sidenav-link-divider"></div>
                <button v-if="!loggedIn" @click="openLogin">Login</button>
                <button v-else @click="logout">Logout</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'loggedIn', 'userData'
        ],
        watch: {
            $route(to, from) {
                this.siderbarIsOpen = false
            }
        },
        methods: {
            openLogin() {
                this.siderbarIsOpen = false;
                this.$emit('openLogin')
            },
            logout(){
                this.siderbarIsOpen = false;
                this.$emit('logout')
            }
        },
        data() {
            return {
                siderbarIsOpen: false,
            }
        }
    }
</script>