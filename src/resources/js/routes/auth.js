import Login from '../pages/Auth/Login';

const routes = [
  {
    name: 'login',
    path: '/login',
    component: Login,
    meta: {
      public: true
    }
  },
];

export default {
  routes
};
