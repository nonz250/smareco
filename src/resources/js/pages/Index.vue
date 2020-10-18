<template>
  <div>
    <heading>スマレコへようこそ</heading>
    <div class="card">
      <div class="card-body p-5">
        <div class="row no-gutters">
          <div class="col-md-3">
            <img
              src="/storage/images/undraw_project_completed_w0oq.png"
              width="300"
              class="w-100"
            >
          </div>
          <div class="col-md-9">
            <p>スマレコは会員情報から取引情報を取得し、その会員に最適な商品を演算し、ピックアップします。</p>
            <p>ピックアップされた情報をオススメの商品として宣伝したり、オススメの商品としてピックアップされたものが多い商品をセール品として販売したり、利用方法は多岐に渡ります。</p>
            <p />
            <p>早速、会員情報を同期して取引情報を分析してみましょう。</p>
            <div class="w-100 text-right">
              <router-link
                to="login"
                class="btn btn-outline-primary"
              >
                ログインページへ
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body p-5">
        <div class="row no-gutters">
          <div class="col-md-8">
            <p>分析作業にAIを利用しています。分析作業には時間がかかりますが、その間は休憩したり、他の作業ができます。</p>
            <p />
            <p>スマレコで浮いた時間を有効に活用して、より効率的に業務を進めましょう。</p>
            <div class="w-100 text-right">
              <router-link
                to="login"
                class="btn btn-outline-primary"
              >
                ログインページへ
              </router-link>
            </div>
          </div>
          <div class="col-md-4">
            <img
              src="/storage/images/undraw_screen_time_vkev.png"
              width="300"
              class="w-100"
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Heading from '../atoms/Heading/Heading';
export default {
  name: 'Index',
  components: {Heading},
};
</script>

<style scoped>

</style>
