import Index from '../pages/Index';
import Term from '../pages/Term';
import PrivacyPolicy from '../pages/PrivacyPolicy';
import Support from '../pages/Support';
import Home from '../pages/Home';

const routes = [
  {
    name: 'top',
    path: '/',
    component: Index,
    meta: {
      public: true,
    }
  },
  {
    name: 'home',
    path: '/home',
    component: Home,
    meta: {
      public: true,
    }
  },
  {
    name: 'term',
    path: '/term',
    component: Term,
    meta: {
      public: true,
    }
  },
  {
    name: 'privacy_policy',
    path: '/privacy_policy',
    component: PrivacyPolicy,
    meta: {
      public: true,
    }
  },
  {
    name: 'support',
    path: '/support',
    component: Support,
    meta: {
      public: true,
    }
  },
];

export default {
  routes
};
