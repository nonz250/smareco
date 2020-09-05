import Vue from 'vue';
import VueRouter from 'vue-router';

import top from '../routes/top';
import auth from '../routes/auth';
import customer from '../routes/customer';

Vue.use(VueRouter);

let routes = [];
routes = routes.concat(top.routes);
routes = routes.concat(auth.routes);
routes = routes.concat(customer.routes);

export default new VueRouter({
  mode: 'history',
  routes
});
