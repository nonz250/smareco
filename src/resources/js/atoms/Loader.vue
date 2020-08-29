<template>
  <span
    v-if="loading"
    class="spinner-grow"
    :class="loaderClass"
    role="status"
    aria-hidden="true"
  />
</template>

<script>
export default {
  name: 'Loader',
  props:{
    loading: {
      type: Boolean,
      require: true,
    },
    small: {
      type: Boolean,
      default: false,
    },
    large: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    loaderClass() {
      let className = '';
      if (this.small) {
        className = 'spinner-grow-sm';
      } else if (this.large) {
        className = 'spinner-grow-lg';
      }
      return {[className]: true};
    }
  }
};
</script>

<style scoped>

</style>
