<template>
  <button
    class="btn"
    :class="{'btn-success': !outline, 'btn-outline-success': outline}"
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
  name: 'SuccessButton',
  components: {Loader},
  props: {
    outline: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: false,
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
