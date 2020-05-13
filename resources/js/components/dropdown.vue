<template>
    <div class="dropdown">
        <button @click="isOpen = !isOpen" class="dropdown-current">
            <span v-for="selected in newCurrent">{{selected.name}}</span>
        </button>
        <div class="dropdown-options" v-if="isOpen">
            <div class="dropdown-option" v-for="option in options">
                <input type="checkbox" :checked="option.status" :id="option.value" :value="option" v-model="newCurrent">
                <label :for="option.value">{{option.name}}</label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['options', 'current'],
        data() {
            return {
                isOpen: false,
                optionsStatus: [],
                newCurrent: [],
            }
        },
        watch: {
            newCurrent: function () {
                this.$emit('setCurrent', this.newCurrent)
            },
        },
        mounted() {
            this.newCurrent = this.current;
            this.optionsStatus = this.options;
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
                min-width: 100%;
                &+span:before{
                    content: ', ';
                }
            }
        }

        .dropdown-options {
            width: 100%;

            .dropdown-option {
                width: 100%;
                text-align: left;
                display: block;
            }
        }
    }
</style>