<template>
    <div class="dropdown">
        <button @click="isOpen = !isOpen" class="dropdown-current">
            <span v-for="selected in newCurrent">{{selected.name}}</span>
            <div class="dropdown-icon">
                <i class="fas fa-chevron-down" v-if="!isOpen"></i>
                <i class="fas fa-chevron-up" v-else></i>
            </div>
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

</style>