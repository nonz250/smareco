<template>
  <button
    class="btn"
    :class="{'btn-success': !outline, 'btn-outline-success': outline}"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'SuccessButton',
  props: {
    outline: {
      type: Boolean,
      default: false,
    }
  }
};
</script>

<style scoped>

</style>
