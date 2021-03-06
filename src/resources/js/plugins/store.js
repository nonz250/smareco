import Vue from 'vue';
import Vuex from 'vuex';
import auth from '../store/auth';
import toast from '../store/toast';
import syncHistory from '../store/syncHistory';
import syncNecessary from '../store/syncNecessary';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth,
    toast,
    syncHistory,
    syncNecessary,
  }
});
