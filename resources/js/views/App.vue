<template>
    <div>
        <NavBar @logout="loggedIn = false" @openLogin="openLogin" :loggedIn="loggedIn"></NavBar>
        <Modal v-if="modal_open || ($route.params.loggedIn !== undefined && !$route.params.loggedIn)" @loggedIn="loggedInHandler" @close="closeLogin"></Modal>
        <div class="main">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import NavBar from '../components/Navbar.vue'
    import Modal from '../components/Modal.vue'

    export default {
        data() {
            return {
                loggedIn: false,
                modal_open: false,
            }
        },
        methods: {
            openLogin() {
                this.modal_open = true;
            },
            closeLogin() {
                this.modal_open = false;
            },
            loggedInHandler(e) {
                this.loggedIn = true;
                console.log(e);
            },
        },
        components: {Modal, NavBar},
    }
</script>
