<template>
  <button
    class="btn"
    :class="{'btn-secondary': !outline, 'btn-outline-secondary': outline}"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'DefaultButton',
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
