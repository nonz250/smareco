const state = {
  user: {},
  logged_in: false,
};

const getters = {
  user: state => state.user,
  logged_in: state => Object.keys(state.user).length > 0
};

const mutations = {
  setter (state, payload) {
    state.user = payload;
  },
  clear(state) {
    state.user = {};
  }
};

const actions = {
  setUser (context, user) {
    context.commit('setter', user);
  },
  clearUser(context) {
    context.commit('clear');
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
