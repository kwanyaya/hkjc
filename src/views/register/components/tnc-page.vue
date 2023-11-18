<script setup>
import { computed, ref } from 'vue'
import { useRoute } from 'vue-router'

import { language } from '@/stores/language'
import { tnc } from '@/locales/tnc_g'
import { tnca } from '@/locales/tnc_a'

const router = useRoute()
const selectTab = ref(0)

const swTab = (t) => {
  selectTab.value = t
  document.getElementsByClassName('content')[0].scroll(0, 0)
}

// console.log(router.params.group)

const mapList = {
  Fjw8mrie52ofnek: '11',
  Npl72jmwk38jdo: '12',
}

const userGroup = computed(() => {
  if (mapList[router.params.group] != undefined)
    return mapList[router.params.group]
  return router.params.group
})

if (router.params.group == 'public') {
  selectTab.value = 1
}

// tnc_a.js
</script>

<template>
  <div class="tnc-bg">
    <div class="tnc-box">
      <div class="tab-box">
        <div
          v-if="userGroup != 'public'"
          :class="selectTab == '0' ? 'tab-sed' : ''"
          class="tab"
          @click="swTab('0')"
        >
          <div class="tab-t">
            {{ tnc[language]['title0'] }}
          </div>
        </div>
        <div
          :class="[
            selectTab == '1' ? 'tab-sed' : '',
            userGroup == 'public' ? 'wh' : '',
          ]"
          class="tab"
          @click="swTab('1')"
        >
          <div class="tab-t">
            {{ tnc[language]['title1'] }}
          </div>
        </div>
        <div
          :class="[
            selectTab == '2' ? 'tab-sed' : '',
            userGroup == 'public' ? 'wh' : '',
          ]"
          class="tab"
          @click="swTab('2')"
        >
          <div class="tab-t">
            {{ tnc[language]['title2'] }}
          </div>
        </div>
      </div>

      <div class="close">
        <slot>X</slot>
      </div>
      <div class="content">
        <!-- <ol v-if="selectTab == '0'">
                    <div style="color: var(--cy);" v-if="userGroup == '12'&&language =='en'">
                        <div  v-for="o in tnca[`tnc_${userGroup}`][language]['to']">
                            {{ o }}
                        </div>
                    </div>
                    <li v-for="t in tnca[`tnc_${userGroup}`][language]['public']">
                        {{ t }}
                    </li>
                </ol>
                <ol v-else>
                    <div v-show="selectTab == '1'">
                        <li v-for="t in tnc[language]['1']">
                            {{ t }}
                        </li>
                    </div>
                    <div v-show="selectTab == '2'">
                        <li v-for="t in tnc[language]['2']">
                            {{ t }}
                        </li>
                    </div>
                    <li v-for="p in tnc[language]['public']">
                        {{ p }}
                    </li>
                </ol> -->
      </div>
    </div>
  </div>
</template>

<style scoped>
.tnc-bg {
  width: 100%;
  height: 100%;
  background-color: var(--cb);
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 999;
  max-width: 500px;
}

.tnc-box {
  background-color: var(--cr);
  height: 100%;
}

.close {
  margin-top: 3%;
  margin-bottom: 2%;
  margin-left: auto;
  margin-right: 3%;
  width: 6.5%;
}

.tab-box {
  width: 100%;
  display: flex;
  height: 8.5%;
  min-height: fit-content;
  justify-content: space-between;
}

.tab {
  background-color: var(--cy);
  color: var(--cr);
  width: 33%;
  border-radius: 0px 10px 0px 0;
  font-size: 12px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tab-t {
  transform: scale(0.8);
}

.tab-sed {
  background-color: var(--cr);
  color: #fff;
  /* border-radius: 15px 0; */
}

.wh {
  width: 49.5% !important;
}

.content {
  padding: 3% 7% 9% 0;
  height: 84%;
  text-align: justify;
  overflow: scroll;
  font-size: 12px;
  word-break: normal;
  word-wrap: break-word;
}

.content > div > div {
  margin-bottom: 5%;
}
</style>
