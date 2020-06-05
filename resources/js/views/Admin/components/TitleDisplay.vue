<template>
  <div class="admin-main-program-title-holder">
    <div class="admin-main-program-title">
      {{ display.name }}
    </div>
    <div class="admin-main-program-icon">
      <i class="fas fa-ellipsis-v" />
    </div>
  </div>
</template>

<script>

export default {
    name: 'TitleDisplay',
    props: ['display'],
    data () {
        return {

        };
    },
    mounted () {}
};
</script>
