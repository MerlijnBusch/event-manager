<template>
    <div>
        <div class="navbar">
            <div class="navbar-inner">
                <div v-if="loggedIn" class="navbar-user">
                    Welkom
                    <span class="navbar-user-name">{{ $user.data.name }}</span>!
                </div>
                <img class="navbar-logo" src="/img/nz-logo-light.png">
                <button class="navbar-hamburger" @click="siderbarIsOpen = true">
                    <div>
                        <div />
                    </div>
                </button>
            </div>
        </div>
        <div class="sidenav" :class="{ 'sidenav-hidden': !siderbarIsOpen }">
            <button
                class="sidenav-close modal-close"
                @click="siderbarIsOpen = false"
            >
                <div>
                    <div />
                </div>
            </button>
            <div class="sidenav-links">
                <router-link to="/" exact>
                    Home
                </router-link>
                <router-link v-if="loggedIn" to="/Profile">
                    Profiel
                </router-link>
                <div class="sidenav-link-divider" />
                <button v-if="!loggedIn" @click="openLogin">
                    Inloggen
                </button>
                <router-link v-if="!loggedIn" to="/user-registration">
                    Registreren
                </router-link>
                <button v-else @click="logout">
                    Uitloggen
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['loggedIn', 'userData'],
    watch: {
        $route (to, from) {
            this.siderbarIsOpen = false;
        }
    },
    methods: {
        openLogin () {
            this.siderbarIsOpen = false;
            this.$emit('openLogin');
        },
        logout () {
            this.siderbarIsOpen = false;
            this.$emit('logout');
        }
    },
    data () {
        return {
            siderbarIsOpen: false
        };
    }
};
</script>
