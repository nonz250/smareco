const state = {
  syncHistory: {},
};

const getters = {
  syncHistory: state => state.syncHistory,
};

const mutations = {
  setSyncHistory (state, syncHistory) {
    state.syncHistory = syncHistory;
  },
};

const actions = {
  setSyncHistory (context, syncHistory) {
    context.commit('setSyncHistory', syncHistory);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
