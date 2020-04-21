<template>
    <div>
        <div class="navbar">
            <div class="navbar-inner">
                <img class="navbar-logo" src="/img/nz-logo-light.png">
                <button class="navbar-hamburger" @click="siderbarIsOpen = true">
                    <div>
                        <div></div>
                    </div>
                </button>
            </div>
        </div>
        <div class="sidenav" :class="{'sidenav-hidden' : !siderbarIsOpen}">
            <button class="sidenav-close" @click="siderbarIsOpen = false">
                <div>
                    <div></div>
                </div>
            </button>
            <div class="sidenav-links">
                <router-link to="/" exact>Home</router-link>
                <router-link to="/about">About</router-link>
                <div class="sidenav-link-divider"></div>
                <button v-if="!loggedIn" @click="openLogin">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'loggedIn'
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
            }
        },
        data() {
            return {
                siderbarIsOpen: false,
            }
        }
    }
</script>