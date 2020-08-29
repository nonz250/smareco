<template>
  <button
    class="btn"
    :class="{'btn-primary': !outline, 'btn-outline-primary': outline}"
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
  name: 'PrimaryButton',
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
