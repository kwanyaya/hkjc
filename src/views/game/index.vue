<script setup>
import {
  defineAsyncComponent,
  onMounted,
  provide,
  ref,
  watch,
  computed,
} from 'vue'
import { useRoute, useRouter } from 'vue-router'

import { language } from '@/stores/language'
import { currentPopup } from '@/stores/gamePopup'

import Subject from '@/components/subject.vue'

// import { useUser } from '@/stores/user'

// import { useTextStore } from '@/locales/text'

// import entry from './components/QrcodeEntry.vue'

// const route = useRoute()
// const router = useRouter()

// const user = useUser()

// const textStore = useTextStore()

// const page = ref('')

const popPage = ref('')

const componentList = []

// 動態選擇components/page
const loadComponents = (g) => {
  // const game1 = defineAsyncComponent(() => import('./components/game1.vue'))
  // const game2 = defineAsyncComponent(() => import('./components/game2.vue'))
  const site = defineAsyncComponent(() => import('./components/act-page.vue'))
  const game = defineAsyncComponent(() => import('./components/game-page.vue'))
  // componentList.push(game1)
  // componentList.push(game2)
  componentList.push(site)
  componentList.push(game)
  // // console.log("g::" + g)
  // if (beerGroup(g)) {
  //   const beer = defineAsyncComponent(() => import('./components/beer.vue'))
  //   componentList.unshift(beer)
  // } else if (coffeeGroup(g)) {
  //   const coffee = defineAsyncComponent(() => import('./components/coffee.vue'))
  //   componentList.unshift(coffee)
  // }
  // console.log(componentList)
}

// const uidLogin = async () => {
//   const login_result = await user.UserLogin({ uid: route.params.id })
//   if (login_result) {
//     loadComponents(user.User.userinfo.user_group)
//     page.value = 'entry'

//     if (user.User.userinfo.user_group == '0') {
//       page.value = 'event'
//     }
//     return
//   }
//   router.push('/')
// }

// if (route.params.id != '') {
//   uidLogin()
// }
// userLevel

provide('popPage', popPage)
// watch(route, () => {
//   uidLogin()
// })

// const coffeeGroup = (userGroup) => {
//   return ['5', '32'].includes(userGroup)
// }

// const beerGroup = (userGroup) => {
//   return ['22', '12'].includes(userGroup)
// }

// const timeout = ref(false)
// const scrolling = ref(false)
// const s_num = ref(0)

// const dateReload = () => {
//   if (timeout.value) return
//   timeout.value = true
//   console.log('re')
//   user.UserLogin({ uid: route.params.id })
//   setTimeout(() => {
//     if (!timeout.value) return
//     timeout.value = false
//   }, 4000)
// }

// function scroll() {
//   if (scrolling.value == false) {
//     scrolling.value = true

//     const { scrollTop } = document.documentElement

//     if (s_num.value <= scrollTop) {
//     } else {
//       dateReload()
//     }
//     s_num.value = scrollTop
//     scrolling.value = false
//   }
// }

// const currentFinished = computed(() => {
//   if (user.User.userinfo != {}) {
//     console.log(user.User.userinfo)
//     return user.User.userinfo.game1.total >= 4
//   }
//   return false
// })

// watch(popPage, () => {
//   dateReload()
// })
// onMounted(() => {
//   // window.addEventListener('scroll', scroll)
// })

// test
loadComponents()
</script>
<template>
  <div class="game">
    <Subject />
    <div class="game-event-p">
      <img :src="`/images/game_event_p_${language}.png`" alt="" srcset="" />
    </div>
    <div class="game-event">
      <div>{{ currentPopup }}</div>
      <component
        :is="item"
        v-for="(item, index) in componentList"
        :key="index"
        class="margin-c"
      ></component>
    </div>
  </div>
</template>
<style scoped>
.game {
  height: 100%;
  background: linear-gradient(
    0deg,
    #1077b3 2.28%,
    #197eb9 13.97%,
    #3492c9 33.45%,
    #5cb0e1 56.83%
  );

  display: flex;
  flex-direction: column;
}

.game-event-p {
  margin: 21rem auto;
}
.game-event {
  width: 82%;
  margin: 0 auto;
}
</style>
