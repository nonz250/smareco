<template>
  <div>
    <navbar />
    <transition mode="out-in">
      <div
        class="container"
        style="margin-top: 75px;"
      >
        <router-view />
      </div>
    </transition>
    <base-toast
      v-model="toast"
      :title="content.title"
      :time="content.time"
    >
      <div
        v-for="(message, index) in content.messages"
        :key="index"
      >
        {{ message }}
      </div>
    </base-toast>
  </div>
</template>

<script>
import Navbar from './components/Navbar';
import BaseToast from './atoms/Toasts/BaseToast';
export default {
  name: 'App',
  components: {BaseToast, Navbar},
  computed: {
    toast: {
      get() {
        return this.$store.getters['toast/toast'];
      },
      set(value) {
        this.$store.dispatch('toast/setToast', value);
      }
    },
    content() {
      return this.$store.getters['toast/content'];
    }
  }
};
</script>

<style scoped>

</style>
