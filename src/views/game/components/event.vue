<script setup>
import { language } from '@/stores/language'

import { currentPopup, SetCurrentPopup } from '@/stores/gamePopup'

const props = defineProps({
  selfpage: String,
})

console.log(props.selfpage)

// const selfpage = 'act'
</script>

<template>
  <div class="event-box">
    <div class="event-title" @click="SetCurrentPopup(selfpage)">
      <img src="@/assets/act.png" alt="" />
      <div class="event-title-box" :class="language == 'tc' ? '' : ''">
        <div class="event-title-des"></div>
        <div class="event-title-content"></div>
        <div class="event-title-arrow">
          <img
            v-if="currentPopup !== selfpage"
            src="@/assets/arrow_close_hotspot.png"
          />
          <img v-else src="@/assets/arrow_open_hotspot.png" />
        </div>
      </div>
    </div>
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
  flex: 1;
}
.event-title-arrow {
  width: 21.54rem;
  margin-right: 12.9rem;
}
</style>
