<template>
  <div>
    <heading>会員一覧</heading>
    <div class="card my-3">
      <div class="card card-body">
        <input-text
          v-model="name"
          placeholder="会員名"
        />
      </div>
      <div class="card card-footer">
        <div class="row">
          <div class="col-8" />
          <div class="col-4 text-right">
            <primary-button @click="fetchCustomers">
              検索
            </primary-button>
          </div>
        </div>
      </div>
    </div>
    <paginate
      v-if="paginate.items.length"
      :last-page="paginate.last_page"
      :current-page="paginate.current_page"
      @pre="pre"
      @page="clickPage"
      @next="next"
    />
    <ul class="list-group my-3">
      <li
        v-if="loading"
        class="list-group-item text-center"
      >
        <loader :loading="loading" />
      </li>
      <li
        v-for="(customer, index) in paginate.items"
        v-show="!loading"
        :key="index"
        class="list-group-item"
      >
        <div class="media">
          <div class="media-body">
            <h5 class="mt-0">
              {{ customer.name }}
            </h5>
            <div class="row">
              <div class="col">
                最終来店日時：{{ customer.last_coming_datetime ? customer.last_coming_datetime : 'まだ来店されていません。' }}
              </div>
              <div class="col text-right">
                契約ID：{{ customer.contract_id }}
              </div>
            </div>
            <div class="row">
              <div class="col">
                <span class="mr-1">メールアドレス：{{ customer.email ? customer.email : 'メールアドレスは登録されていません。' }}</span>
                <span class="mr-1">電話番号：{{ customer.phone ? customer.phone : '電話番号は登録されていません。' }}</span>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <paginate
      v-if="paginate.items.length"
      :last-page="paginate.last_page"
      :current-page="paginate.current_page"
      @pre="pre"
      @page="clickPage"
      @next="next"
    />
  </div>
</template>

<script>
import GetCustomers from '../../src/Customers/UseCases/GetCustomers';
import InputText from '../../atoms/Inputs/InputText';
import PrimaryButton from '../../atoms/PrimaryButton';
import Heading from '../../atoms/Heading/Heading';
import Loader from '../../atoms/Loader';
import Paginate from '../../components/Paginate';

export default {
  name: 'Index',
  components: {Paginate, Loader, Heading, PrimaryButton, InputText},
  data() {
    return {
      loading: false,
      getCustomerUseCase: new GetCustomers(),
      paginate: {
        last_page: 0,
        items: 0,
        total: 0,
        current_page: 0,
      },
      name: '',
      storeId: '',
      page: 1,
      length: 100,
      order: 'asc',
      orderKey: 'name',
    };
  },
  async created() {
    await Promise.all([this.fetchCustomers()]);
  },
  methods: {
    async fetchCustomers() {
      this.loading = true;
      try {
        this.paginate = await this.getCustomerUseCase.process({
          name: this.name,
          store_id: this.storeId,
          page:this.page,
          length: this.length,
          order: this.order,
          order_key: this.orderKey
        });
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
    async pre() {
      this.page--;
      await this.fetchCustomers();
    },
    async clickPage(page) {
      this.page = page;
      await this.fetchCustomers();
    },
    async next() {
      this.page++;
      await this.fetchCustomers();
    },
  }
};
</script>

<style scoped>

</style>
