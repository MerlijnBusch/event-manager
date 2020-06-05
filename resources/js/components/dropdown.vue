<template>
  <div class="dropdown">
    <div
      class="dropdown-current"
      @click="isOpen = !isOpen"
    >
      <span
        v-for="selected in newCurrent"
        :key="'selected-' + selected"
        style="margin: 5px;"
      >{{ selected }}</span>
      <span
        v-if="!newCurrent.length"
        class="dropdown_placeholder"
      >{{ placeholder }}</span>
      <div class="dropdown-icon">
        <i
          v-if="!isOpen"
          class="fas fa-chevron-down"
        />
        <i
          v-else
          class="fas fa-chevron-up"
        />
      </div>
    </div>
    <div
      v-if="isOpen"
      class="dropdown-options"
    >
      <label
        v-for="option in options"
        :key="'dropdown-option_' + option"
        class="dropdown-option"
        :class="{'dropdown-option-selected': newCurrent.includes(option)}"
      >
        <input
          v-model="newCurrent"
          type="checkbox"
          :value="option"
        >
        <span>{{ option }}</span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
    props: ['options', 'current', 'placeholder'],
    data () {
        return {
            isOpen: false,
            optionsStatus: [],
            newCurrent: []
        };
    },
    watch: {
        newCurrent: function () {
            this.$emit('setCurrent', this.newCurrent);
        },
        current: async function (newVal, oldVal) {
            this.newCurrent = this.current;
        }
    },
    mounted () {
        this.newCurrent = this.current;
        this.optionsStatus = this.options;
    }
};
</script>
<!--TODO: Give some actual good styling and not in the .VUE file-->
<style lang="scss">

</style>
