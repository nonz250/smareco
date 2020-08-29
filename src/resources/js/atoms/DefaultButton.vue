<template>
  <button
    class="btn"
    :class="{'btn-secondary': !outline, 'btn-outline-secondary': outline}"
    :disabled="disabled"
    @click="$emit('click')"
  >
    <loader
      :loading="loading"
      small
    />
    <slot />
  </button>
</template>

<script>
import Loader from './Loader';
export default {
  name: 'DefaultButton',
  components: {Loader},
  props: {
    outline: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: true,
    },
    disabled: {
      type: Boolean,
      default: false,
    }
  }
};
</script>

<style scoped>

</style>
