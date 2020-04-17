<template>
    <div>
        <div class="navbar"><!--Nav Bar-->
            <div class="navbar-inner">
                <img class="navbar-logo" src="/img/nz-logo-light.png">
                <button class="navbar-hamburger" @click="hamburger = false">{{hamburger}}</button>
            </div>
        </div>
        <div class="sidenav" :class="{'sidenav-hidden' : hamburger}">
            <button class="sidenav-close" @click="hamburger = true">close</button>
            <router-link to="/" exact>home</router-link>
            <router-link to="/about">about</router-link>
        </div>
        <div class="main">
        <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hamburger: true,
            }
        }
    }
</script>
