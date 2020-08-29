const state = {
  toast: false,
  content: {
    title: '',
    time: '',
    messages: []
  },
};

const getters = {
  toast: state => state.toast,
  content: state => state.content
};

const mutations = {
  setToast (state, toast) {
    state.toast = toast;
  },
  setContent(state, content) {
    state.content = content;
  }
};

const actions = {
  setToast (context, toast) {
    context.commit('setToast', toast);
  },
  setContent(context, content) {
    context.commit('setContent', content);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
