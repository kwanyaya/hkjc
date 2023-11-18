<script setup>
import { inject, ref } from 'vue'
import { language } from '@/stores/language'

// import { useUser } from '@/stores/user'
import { currentPopup, SetCurrentPopup } from '@/stores/gamePopup'

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
  <div class="c-b">
    <div class="g" @click="SetCurrentPopup(selfpage)">
      <img src="@/assets/act.png" alt="" />
      <div
        class="g-content textline1 fake-center-r text-bold"
        :class="language == 'tc' ? 'text_m' : 'text_m3'"
      ></div>
    </div>

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
.g {
  position: relative;
  height: fit-content;
  width: 82%;
  margin: auto;
}

.g-content {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--cr);
}

.event-bg {
  margin: 2% auto;
  position: relative;
  height: fit-content;
}

.event-box {
  margin: auto;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 82%;
  height: 90%;
  /* display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; */
}

.eventpopup-bg {
  width: 100%;
  height: 100%;
  background-color: #0000007c;
  padding: 6%;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 999;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  max-width: 500px;
  margin: 0 auto;
}
.eventpopup-box {
  background-color: var(--cr);
  padding: 6% 7% 9%;
}

.close {
  margin-left: auto;
  margin-bottom: 3%;
  width: 7%;
}

.eventc-box {
  position: relative;
  width: 96%;
  margin: auto;
}
</style>
