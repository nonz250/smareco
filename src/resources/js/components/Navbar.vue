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
    >
      <div class="navbar-nav">
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
    </div>
    <a
      href="/login"
      class="btn btn-outline-light mx-1"
    >
      ログイン
    </a>
    <form
      action="/logout"
      method="post"
    >
      <input
        type="hidden"
        name="_token"
        :value="csrfToken"
      >
      <button class="btn btn-outline-light mx-1">
        ログアウト
      </button>
    </form>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  computed: {
    csrfToken() {
      return document.getElementsByName('csrf-token').item(0).content;
    }
  }
};
</script>

<style scoped>

</style>
