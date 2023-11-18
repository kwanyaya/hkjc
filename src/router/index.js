import { createRouter, createWebHashHistory } from 'vue-router'

// import { useAdminStore } from '@/stores/admin.js'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('@/views/register/index.vue'),
  },
  {
    path: '/g/:group',
    component: () => import('@/views/register/index.vue'),
  },
  {
    path: '/user',
    redirect: { name: 'Home' },
  },
  {
    path: '/user/:id',
    component: () => import('@/views/game/index.vue'),
  },
  // {
  //   path: '/admin',
  //   component: () => import('@/views/admin/index.vue'),
  //   children: [
  //     {
  //       path: 'login',
  //       component: () => import('@/views/admin/login/login.vue'),
  //       beforeEnter: (to, from) => {
  //         const adminStore = useAdminStore()
  //         const { token } = adminStore
  //         const level = adminStore.userlevel
  //         if (token.value && level.value) {
  //           return '/admin/home'
  //         }
  //         return true
  //       },
  //     },
  //     {
  //       path: 'home',
  //       component: () => import('@/views/admin/page/index.vue'),
  //       beforeEnter: (to, from) => {
  //         const adminStore = useAdminStore()
  //         const { token } = adminStore
  //         const level = adminStore.userlevel
  //         if (token.value && level.value) {
  //           return true
  //         }
  //         adminStore.ClearStorage()
  //       },
  //     },
  //     {
  //       path: '',
  //       redirect: { name: 'Home' },
  //     },
  //   ],
  // },
  // {
  //   path: '/admin',
  //   component: () => import('@/views/admin/index.vue'),
  // },
  { path: '/:pathMatch(.*)*', redirect: { name: 'Home' } },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes,
})
// trackRouter(router);
export default router
