<template>
  <input
    v-model="text"
    type="text"
    class="form-control"
    :placeholder="placeholder"
    :max="max"
    :min="min"
  >
</template>

<script>
export default {
  name: 'InputText',
  props: {
    value: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: ''
    },
    max: {
      type: Number,
      default: 100
    },
    min: {
      type: Number,
      default: 0
    }
  },
  computed: {
    text: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      }
    }
  }
};
</script>

<style scoped>

</style>
