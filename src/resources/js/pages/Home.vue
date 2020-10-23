<template>
  <div>
    <heading>スマレコへようこそ</heading>
    <div class="card">
      <div class="card-body">
        <p>スマレコは会員が購入した商品から<strong>AI</strong>を利用してオススメの商品を導き出すアプリケーションです。</p>
        <p>このデータを利用して会員へ「今週のオススメ商品リスト」をメールで送信してもよし。店舗で扱う商品を検討してもよし。</p>
        <p>スマレコを利用して更に売上UPを目指しましょう！</p>
        <p><small>※性能の都合上、分析は直近1ヶ月間のみに絞っております。</small></p>
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
    <br>
    <br>
    <heading>直近の分析結果</heading>
    <small>
      分析を結果をメールで通知する機能は現在準備中です。しばらくお待ち下さい。<br>
      定期的にこのページをリロードして最新の分析結果をご覧下さい。
    </small>
    <analyzed />
  </div>
</template>

<script>
import PrimaryButton from '../atoms/PrimaryButton';
import Heading from '../atoms/Heading/Heading';
import SuccessButton from '../atoms/SuccessButton';
import SyncCustomer from '../src/Customers/UseCases/SyncCustomer';
import AnalyzeTransaction from '../src/AnalyzeTransaction/UseCases/AnalyzeTransaction';
import Analyzed from '../components/Analyzed';
export default {
  name: 'Home',
  components: {Analyzed, SuccessButton, Heading, PrimaryButton},
  data() {
    return {
      syncCustomerUseCase: new SyncCustomer(),
      analyzeTransactionUseCase: new AnalyzeTransaction(),
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
      this.loading = true;
      try {
        await this.analyzeTransactionUseCase.process();
      } catch (e) {
        await this.$store.dispatch('toast/setToast', true);
        await this.$store.dispatch('toast/setContent', {
          title: 'エラー',
          messages: [e.exception],
        });
        return;
      } finally {
        this.loading = false;
      }
      await this.$store.dispatch('toast/setToast', true);
      await this.$store.dispatch('toast/setContent', {
        title: 'スマレコ',
        messages: ['演算には時間がかかります。しばらくお待ち下さい。'],
      });
    }
  }
};
</script>

<style scoped>

</style>
