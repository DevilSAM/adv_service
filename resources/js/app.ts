import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

import {createApp} from 'vue'
import {createPinia} from 'pinia'
import router from './router';
import ElementPlus from 'element-plus';
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import AppComponent from "./App.vue";
import 'bootstrap';
import {authStore} from "@/stores/authStore";

const app = createApp(AppComponent)

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
  app.component(key, component)
}

app.use(createPinia())
app.use(ElementPlus)

// Check auth
router.beforeEach((to) => {
  const auth = authStore();
  if (to.meta.requiresAuth && !auth.userData) {
    return '/login'
  }

  // Redirect authorized users from guest pages
  if (to.meta.onlyGuests && auth.userData) {
    return '/'
  }
})

const auth = authStore();

// Checking auth and mount app
auth.checkAuth()
  .finally(() => {
    app.use(router)
    app.mount('#app')
  });
