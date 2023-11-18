<script setup>
import { inject, ref } from 'vue'
import { language } from '@/stores/language'

// import { useUser } from '@/stores/user'
import { currentPopup, SetCurrentPopup } from '@/stores/gamePopup'

import Event from './event.vue'

// import { useTextStore } from '@/locale/text'
const selfpage = 'act'

const popPage = inject('popPage')

// const user = useUser()

// const textStore = useTextStore()

// const eventpopup = ref('')

// const showFunc = () => {
//   if (pop.value == _self) {
//     pop.value = ''
//     return
//   }
//   pop.value = _self
// }
// const popT = (windows) => {
//   eventpopup.value = windows
// }
// const tncFunc = (t = '') => {
//   eventpopup.value = t
// }
</script>

<template>
  <div class="event-box">
    <Event :selfpage="selfpage" />
    <div v-show="currentPopup == selfpage" class="event-bg">
      act popup
      <!-- <img :src="`./game/all_event_${lang}.png`" alt="" />
      <div class="event-box-font event-box">
        <div class="event-box-font-item" @click="popT('2')"></div>
        <div class="event-box-font-item" @click="popT('2')"></div>
        <div class="event-box-font-item" @click="popT('3')"></div>
        <div class="event-box-font-item" @click="popT('4')"></div>
      </div> -->
    </div>

    <!-- <div v-show="eventpopup != ''" class="eventpopup-bg">
      <div class="eventpopup-box">
        <div class="close">
          <div @click="tncFunc()">
            <img src="@/assets/close.png" alt="" />
          </div>
        </div>
        <div class="eventc-box">
          <img :src="`./game/popup_${eventpopup}_${lang}.png`" alt="" />
        </div>
      </div>
    </div> -->
  </div>
</template>

<style scoped>
.event-title {
  position: relative;
}
.event-title-box {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  margin: auto;
  display: flex;
  align-items: center;
}
.event-title-des {
  width: 30%;
}
.event-title-content {
  /* width: 50%; */
  flex: 1;
}
.event-title-arrow {
  width: 21.54rem;
  margin-right: 12.9rem;
}
</style>
