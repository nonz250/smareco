const state = {
  syncNecessary: {},
  isSync: false,
};

const getters = {
  syncNecessary: state => state.syncNecessary,
};

const mutations = {
  setSyncNecessary (state, syncNecessary) {
    state.syncNecessary = syncNecessary;
    state.isSync = !!syncNecessary;
  },
};

const actions = {
  setSyncNecessary (context, syncNecessary) {
    context.commit('setSyncNecessary', syncNecessary);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
