<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <router-link
      :to="{ name: 'top' }"
      class="navbar-brand"
    >
      スマレコ
    </router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon" />
    </button>
    <div
      id="navbarNavAltMarkup"
      class="collapse navbar-collapse"
      @click="navClick"
    >
      <div class="navbar-nav mr-auto">
        <router-link
          :to="{ name: 'term' }"
          class="nav-link"
          :active-class="'active'"
        >
          利用規約<span class="sr-only">(current)</span>
        </router-link>
        <router-link
          :to="{ name: 'privacy_policy' }"
          class="nav-link"
          :active-class="'active'"
        >
          プライバシーポリシー
        </router-link>
        <router-link
          :to="{ name: 'support' }"
          class="nav-link"
          :active-class="'active'"
        >
          サポート
        </router-link>
      </div>
      <router-link
        v-if="!$store.getters['auth/logged_in']"
        :to="{ name: 'login' }"
        class="btn btn-outline-light mx-1"
      >
        ログイン
      </router-link>
      <form
        v-if="$store.getters['auth/logged_in']"
        action="/logout"
        method="post"
      >
        <input
          type="hidden"
          name="_token"
          :value="csrfToken"
        >
        <light-button
          outline
          class="mx-1"
        >
          ログアウト
        </light-button>
      </form>
    </div>
  </nav>
</template>

<script>
import LightButton from '../atoms/LightButton';
import SuccessButton from '../atoms/SuccessButton';
export default {
  name: 'Navbar',
  components: {SuccessButton, LightButton},
  computed: {
    csrfToken() {
      return document.getElementsByName('csrf-token').item(0).content;
    }
  },
  methods: {
    navClick() {
      $('.navbar-collapse').collapse('hide');
    }
  }
};
</script>

<style scoped>

</style>
