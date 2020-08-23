<template>
  <div>
    <form
      action="/smaregi/openid"
      method="post"
    >
      <input
        type="hidden"
        name="_token"
        :value="csrfToken"
      >
      <div class="row">
        <div class="col-md-2" />
        <div class="col-md-8">
          <h3 class="p-0 mb-0 mx-3">
            ログイン
          </h3>
          <div class="my-3">
            <div class="card">
              <div class="card-header h5">
                スマレジアカウントでログインする
              </div>
              <div class="card-body">
                <p>このアプリを利用するためにはスマレジのアカウントが必要です。</p>
                <p>スマレジのアカウントを作成してからご利用ください。</p>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <button class="btn btn-primary">
                    スマレジでログイン
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2" />
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Login',
  computed: {
    csrfToken() {
      return document.getElementsByName('csrf-token').item(0).content;
    }
  }
};
</script>

<style scoped>

</style>
