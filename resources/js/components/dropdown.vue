<template>
    <div class="dropdown">
        <button @click="isOpen = !isOpen" class="dropdown-current">
            <span v-text="current"></span>
        </button>
        <div class="dropdown-options" v-if="isOpen">
            <button class="dropdown-option" @click="()=>{setCurrent(option); isOpen = false}" v-for="option in options">
                {{option}}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['options', 'current'],
        data(){
            return{
                isOpen: false,
            }
        },
        methods:{
            setCurrent(v){
                this.$emit('setCurrent', v)
            }
        }
    }
</script>
<!--TODO: Give some actual good styling and not in the .VUE file-->
<style lang="scss">
    .dropdown {
        background: blue;

        .dropdown-current {
            width: 100%;
            padding: 24px 12px;
            background: grey;
            text-align: left;

            > span {
                min-height: 1em;
                display: inline-block;
                min-width: 100%;
            }
        }
        .dropdown-options{
            width: 100%;
            .dropdown-option{
                width: 100%;
                text-align: left;
                display: block;
            }
        }
    }
</style>