<template>
    <div class="dropdown">
        <div @click="isOpen = !isOpen" class="dropdown-current">
            <span v-for="selected in newCurrent" style="margin: 5px;">{{selected}}</span>
            <span class="dropdown_placeholder" v-if="!newCurrent.length">{{placeholder}}</span>
            <div class="dropdown-icon">
                <i class="fas fa-chevron-down" v-if="!isOpen"></i>
                <i class="fas fa-chevron-up" v-else></i>
            </div>
        </div>
        <div class="dropdown-options" v-if="isOpen">
            <label class="dropdown-option" v-for="option in options" :class="{'dropdown-option-selected': newCurrent.includes(option)}">
                <input type="checkbox" :value="option" v-model="newCurrent">
                <span>{{option}}</span>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['options', 'current', 'placeholder'],
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
            current: async function(newVal, oldVal) {
                this.newCurrent = this.current;
            }
        },
        mounted() {
            this.newCurrent = this.current;
            this.optionsStatus = this.options;
        }
    }
</script>
<!--TODO: Give some actual good styling and not in the .VUE file-->
<style lang="scss">

</style>
