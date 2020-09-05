<template>
  <div
    aria-live="polite"
    aria-atomic="true"
    class="position-fixed fixed-top w-100 h-100 d-flex justify-content-center align-items-center bg-deep-transparent bg-light"
    :style="!toast ? 'z-index: -1;' : 'cursor: not-allowed;'"
  >
    <div
      id="toast"
      class="toast"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-autohide="false"
      style="cursor: auto;"
    >
      <div class="toast-header">
        <!--<img src="..." class="rounded mr-2" alt="...">-->
        <strong class="mr-auto">{{ title }}</strong>
        <small>{{ time }}</small>
        <button
          type="button"
          class="ml-2 mb-1 close"
          data-dismiss="toast"
          aria-label="Close"
          @click="toast = false"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseToast',
  props: {
    value: {
      type: Boolean,
      required: true,
    },
    title: {
      type: String,
      default: '',
    },
    time: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      uuid: '',
    };
  },
  computed: {
    toast: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit('input', value);
      }
    }
  },
  watch: {
    toast(value) {
      if (value) {
        $('#toast').toast('show');
      } else {
        $('#toast').toast('hide');
      }
    }
  },
  created() {
    this.uuid = this.generateUuid();
  }
};
</script>

<style scoped>

</style>
