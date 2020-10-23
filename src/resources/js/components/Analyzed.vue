<template>
  <div>
    <div v-if="analyzedList.length">
      <div
        v-for="(analyzed, i) in analyzedList"
        :key="i"
      >
        <div
          v-if="analyzed.data.length"
          class="card m-1"
        >
          <div
            class="card-body"
          >
            {{ analyzed.customer.name }} さんは<br>
            <div class="row">
              <div
                v-for="(item, k) in analyzed.data"
                :key="k"
                class="col"
              >
                <ul class="list-group m-1">
                  <li class="list-group-item">
                    {{ item.product.name }}
                  </li>
                  <li class="list-group-item">
                    相関値：{{ item.num }}
                  </li>
                </ul>
              </div>
            </div>
            以上の商品に相関性がありそうです。<br>
            これらの商品をまとめて購入する傾向があるようです。
          </div>
        </div>
      </div>
    </div>
    <template v-else-if="loading">
      <div class="card m-1">
        <div class="card-body text-center">
          <loader :loading="loading" />
        </div>
      </div>
    </template>
    <template v-else>
      <div class="card m-1">
        <div class="card-body">
          分析結果はまだ作成されていません。
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import GetAnalyze from '../src/Analyze/UseCases/GetAnalyze';
import Loader from '../atoms/Loader';

export default {
  name: 'Analyzed',
  components: {Loader},
  data() {
    return {
      getAnalyzeUseCase: new GetAnalyze(),
      loading: false,
      analyzedList: [],
    };
  },
  async created() {
    await Promise.all([this.getAnalyze()]);
  },
  methods: {
    async getAnalyze() {
      this.loading = true;
      try {
        this.analyzedList = await this.getAnalyzeUseCase.process();
      } catch (e) {
        await this.$store.dispatch('toast/setToast', true);
        await this.$store.dispatch('toast/setContent', {
          title: 'エラー',
          messages: [e.exception],
        });
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>

</style>
