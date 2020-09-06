<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <router-link
      :to="{ name: 'top' }"
      class="navbar-brand"
    >
      <img
        src="/safari-pinned-tab.svg"
        width="30"
        height="30"
        class="d-inline-block align-top bg-white"
        alt=""
        loading="lazy"
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
          v-if="$store.getters['auth/logged_in']"
          :to="{ name: 'home' }"
          class="nav-link"
          :active-class="'active'"
        >
          ホーム<span class="sr-only">(current)</span>
        </router-link>
        <router-link
          v-if="$store.getters['auth/logged_in']"
          :to="{ name: 'customer.index' }"
          class="nav-link"
          :active-class="'active'"
        >
          会員一覧<span class="sr-only">(current)</span>
        </router-link>
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
      <success-button
        v-if="$store.getters['auth/logged_in']"
        outline
        :loading="loading"
        :disabled="loading"
        @click="syncCustomer"
      >
        会員同期 <span
          v-if="$store.getters['syncHistory/syncHistory']"
          class="badge badge-success text-wrap"
        >({{ moment($store.getters['syncHistory/syncHistory'].sync_datetime).format('MM/DD HH:mm') }})</span><span class="sr-only">(current)</span>
      </success-button>
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
import SyncCustomer from '../src/Customers/UseCases/SyncCustomer';
import GetSyncHistory from '../src/SyncHistory/UseCases/GetSyncHistory';
import GetSyncNecessary from '../src/SyncNecessary/UseCases/GetSyncNecessary';

export default {
  name: 'Navbar',
  components: {SuccessButton, LightButton},
  data() {
    return {
      loading: false,
      syncCustomerUseCase: new SyncCustomer(),
      getSyncHistoryUseCase: new GetSyncHistory(),
      getSyncNecessary: new GetSyncNecessary(),
    };
  },
  computed: {
    csrfToken() {
      return document.getElementsByName('csrf-token').item(0).content;
    }
  },
  async created() {
    await Promise.all([this.fetchSyncHistory(), this.fetchSyncNecessary()]);
  },
  methods: {
    navClick() {
      $('.navbar-collapse').collapse('hide');
    },
    async syncCustomer() {
      this.loading = true;
      try {
        await this.$store.dispatch('syncHistory/setSyncHistory', await this.syncCustomerUseCase.process());
      } catch (e) {
        await this.$store.dispatch('toast/setToast', true);
        await this.$store.dispatch('toast/setContent', {
          title: 'エラー',
          messages: [e.exception],
        });
      } finally {
        this.loading = false;
      }
    },
    async fetchSyncHistory() {
      this.loading = true;
      try {
        await this.$store.dispatch('syncHistory/setSyncHistory', await this.getSyncHistoryUseCase.process());
      } catch (e) {
        await this.$store.dispatch('toast/setToast', true);
        await this.$store.dispatch('toast/setContent', {
          title: 'エラー',
          messages: [e.exception],
        });
      } finally {
        this.loading = false;
      }
    },
    async fetchSyncNecessary() {
      try {
        const syncNecessary = await this.getSyncNecessary.process();
        await this.$store.dispatch('syncNecessary/setSyncNecessary', syncNecessary);
        if (syncNecessary) {
          await this.$store.dispatch('toast/setToast', true);
          await this.$store.dispatch('toast/setContent', {
            title: '同期',
            messages: ['新しいデータがあります。同期ボタンを押してデータを更新することをおすすめします。'],
          });
        }
      } catch (e) {
        await this.$store.dispatch('toast/setToast', true);
        await this.$store.dispatch('toast/setContent', {
          title: 'エラー',
          messages: [e.exception],
        });
      }
    }
  }
};
</script>

<style scoped>

</style>
