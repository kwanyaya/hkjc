<script setup>
import { inject } from 'vue'

import { language } from '@/stores/language'

const msg = inject('msg')

// const errMsg = inject('errMsg')
// const successMsg = inject('successMsg')
const homePageFunc = inject('homepageFunc')

// const status = inject('subpageStatus')

// console.log(errMsg)
// console.log(successMsg)
// console.log(status)

// waiting|login|success|fail|full
</script>
<template>
  <div class="msg-box">
    <div class="content">
      <div class="content-event-slot">
        <template v-if="msg.status == 'success'">
          {{ $t('event_slot') }}
        </template>
      </div>

      <div class="content-logo">
        <img v-if="msg.status == 'success'" src="@/assets/done.png" alt="" />
        <img v-else src="@/assets/err.png" alt="" />
      </div>

      <div class="content-text">
        <template v-if="msg.status == 'success'">
          <div
            class="success-text-title"
            :class="language == 'tc' ? 'text_l' : 'text_m'"
          >
            &nbsp;{{ $t('msg')['success']['title'] }}
          </div>
          <div
            class="success-text-text"
            :class="language == 'tc' ? 'text_m2' : 'text_m3'"
          >
            {{ $t('msg')['success']['text'] }}
          </div>
        </template>

        <template v-else>
          <div :class="msg.status == 'full' && 'success-text-title'">
            {{ msg.text }}
          </div>
        </template>
      </div>
    </div>
    <div
      class="reg-btn reg-f"
      :class="language == 'en' ? 'text_m2' : 'text_m3'"
      @click="homePageFunc()"
    >
      {{ $t('login')['submit'] }}
    </div>
  </div>
</template>

<style scoped>
.msg-box {
  font-size: 12rem;
  color: #fff;

  min-height: 420rem;
  display: flex;
  flex-direction: column;
  /* align-items: center; */
  /* justify-content: center; */
}

.content {
  height: 100%;
  font-size: 16rem;
  margin: auto;
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.content-event-slot {
  /* position: absolute; */
  margin: auto;
}

.content-logo {
  width: 118rem;
  margin: 0 auto;
}

.content-text {
  margin: 15rem auto auto;
}

.success-text-title {
  color: var(--cy);
  font-weight: bold;
  font-size: 30rem;
  /* margin-bottom: 10rem; */
}

.success-text-text {
  margin-top: 5rem;
}

.reg-btn {
  margin: auto auto 0;
  width: fit-content;

  background: #000b38;
  width: 145rem;
  height: 42rem;

  font-size: 16rem;

  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
