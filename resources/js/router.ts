import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router"

const routes: Array<RouteRecordRaw> = [
  {
    name: 'HomePage',
    path: '/',
    redirect: '/adverts',
  },
  {
    name: 'AdvertsList',
    path: '/adverts',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/adverts/AdvertsList.vue')
  },
  {
    name: 'AdvertCard',
    path: '/adverts/:id',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/adverts/AdvertCard.vue')
  },
  {
    name: 'AdvertCardCreate',
    path: '/adverts/create',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/adverts/AdvertCreate.vue')
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
