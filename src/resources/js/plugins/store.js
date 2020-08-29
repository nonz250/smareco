import Vue from 'vue';
import Vuex from 'vuex';
import auth from '../store/auth';
import toast from '../store/toast';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    toast,
  }
});
