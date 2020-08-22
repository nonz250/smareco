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
  </div>
</template>

<script>
import Navbar from './components/Navbar';
export default {
  name: 'App',
  components: {Navbar}
};
</script>

<style scoped>

</style>
