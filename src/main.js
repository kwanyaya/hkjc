import { createApp } from 'vue'
import './style.css'

import router from '@/router/index'
import App from './App.vue'

import { localesPlugin } from './locales'

// route
// if (import.meta.env.VITE_ROUTER === 'true') {
//   console.log('init: router')
//   import('./router').then((router) => {
//     app.use(router.default)
//   })
// }

const app = createApp(App)

if (import.meta.env.VITE_PINIA === 'true') {
  console.log('init: pinia')
  console.log(import.meta.env.VITE_PINIA)
  import('./utils/pinia').then((pinia) => {
    app.use(pinia.default)
  })
}
// pinia

app.use(localesPlugin)
app.use(router)
app.mount('#app')
