<template>
  <button
    class="btn"
    :class="{'btn-light': !outline, 'btn-outline-light': outline}"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'LightButton',
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
