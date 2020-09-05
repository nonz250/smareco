import Index from '../pages/Customer/Index';

const routes = [
  {
    name: 'customer.index',
    path: '/customer',
    component: Index,
    meta: {
      public: false,
    }
  },
];

export default {
  routes
};
