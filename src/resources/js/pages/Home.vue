<template>
  <div>
    <heading>スマレコへようこそ</heading>
    <div class="card">
      <div class="card-body">
        <p>スマレコは会員が購入した商品から<strong>AI</strong>を利用してオススメの商品を導き出すアプリケーションです。</p>
        <p>このデータを利用して会員へ「今週のオススメ商品リスト」をメールで送信してもよし。店舗で扱う商品を検討してもよし。</p>
        <p>スマレコを利用して更に売上UPを目指しましょう！</p>
      </div>
      <div class="card-footer text-right">
        会員同期は済ませましたか？
        <success-button
          :loading="loading"
          :disabled="loading"
          @click="syncCustomer"
        >
          会員情報を同期する
        </success-button>
        <primary-button
          :loading="loading"
          :disabled="loading"
          @click="analyze"
        >
          早速分析する
        </primary-button>
      </div>
    </div>
  </div>
</template>

<script>
import PrimaryButton from '../atoms/PrimaryButton';
import Heading from '../atoms/Heading/Heading';
import SuccessButton from '../atoms/SuccessButton';
import SyncCustomer from '../src/Customers/UseCases/SyncCustomer';
export default {
  name: 'Home',
  components: {SuccessButton, Heading, PrimaryButton},
  data() {
    return {
      syncCustomerUseCase: new SyncCustomer(),
      loading: false,
    };
  },
  methods: {
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
    async analyze() {
      await this.$store.dispatch('toast/setToast', true);
      await this.$store.dispatch('toast/setContent', {
        title: 'スマレコ',
        messages: ['現在準備中です。'],
      });
    }
  }
};
</script>

<style scoped>

</style>
