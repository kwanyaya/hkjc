<script setup>
import { onMounted, reactive, ref, inject, provide } from 'vue'
import { useRoute } from 'vue-router'

import { language } from '@/stores/language'
import { useGroup } from '@/stores/group'

import Subject from '@/components/subject.vue'
import LoginPage from './components/login-page.vue'
import MsgPage from './components/msg-page.vue'
import TncPage from './components/tnc-page.vue'

const router = useRoute()
const group = useGroup()

const page = ref('')
const offerGroup = ref('')

const showMsgPage = ref(false)
const block = ref(false)

const errStore = inject('$t')('err')
const loading = inject('loading')
const showTnc = ref(true)

const msg = reactive({
  text: '',
  status: 'waiting',
})

const user = reactive({
  phone: '',
  language: '',
  tnc: false,
  marketing: false,
  user_group: '',
})

const vaildPhone = () => {
  if (user.phone.length > 8) {
    user.phone = user.phone.substring(0, 8)
  }
  user.phone = user.phone.replace(/[^0-9]/g, '')
  if (user.phone.length > 0) {
    user.phone = `${parseInt(user.phone, 10)}`
  }
}

const changeSMSLang = (_lang) => {
  user.language = _lang
}

const toFailPage = (status) => {
  if (status === 'fail') {
    msg.status = 'fail'
  }
  if (status === 'full') {
    msg.status = 'full'
  }

  showMsgPage.value = true
}

const clearMsg = () => {
  msg.text = ''
  msg.status = 'waiting'
}

const home = () => {
  clearMsg()
  showMsgPage.value = false
}

const toSuccessPage = () => {
  clearMsg()
  block.value = true
  msg.status = 'success'
  showMsgPage.value = true
}

const tncFunc = () => {
  showTnc.value = !showTnc.value
  console.log(showTnc.value)
}

const initGroup = () => {
  group.SetUser(router.params.group)
  console.log(group.GetGroup(), group.GetOffer())
  // const initUserGroup = group.GetGroup()

  if (group.GetGroup() === undefined) {
    toFailPage('404')
    return
  }

  if (group.GetGroup() === 'public') {
    page.value = 'public'
  } else {
    page.value = 'register'
  }

  offerGroup.value = group.GetOffer()
}

// checkAvailbaility

const availabilityServerResponse = async (_user) => {
  // const result = await _availability(_user)
  // if (result.data.status == 'fail') {
  //   block.value = false
  //   switch (result.data.msg) {
  //     case 'full':
  // msg.text = errStore.full
  // toFailPage('full')
  // return
  //   }
  // toFailPage('404')
  // }
}

const checkAvailbaility = async () => {
  if (user.user_group === '' || user.user_group === 'public') {
    return
  }

  if (block.value) return
  loading.value = true
  await availabilityServerResponse(user)
  loading.value = false
}

const registerServerResponse = async (_user) => {
  console.log(_user)

  testReg(true)

  // const result = await _register(_user)
  // if (result.data.status == 'success') {
  //   pageIn('success')
  //   user.phone = ''
  //   user.tnc = false
  //   block.value = true
  //   errMsg.value = ''
  //   successMsg.title = textStore('blub_success_t1')
  //   successMsg.text = textStore('blub_success_t2')
  //   successMsg.btn = textStore('blub_btn')
  // }
  // if (result.data.status == 'fail') {
  //   block.value = false
  //   switch (result.data.msg) {
  //     case 'email1 exist':
  //       errMsg.value = errStore.emailbefore
  //       break
  //     case 'phone1 exist':
  //       errMsg.value = errStore.phonebefore
  //       break
  //     case 'server err':
  //       errMsg.value = errStore.network
  //       break
  //     case 'register err':
  //       errMsg.value = errStore.network
  //       break
  //     case 'emailFormatErr':
  //       errMsg.value = errStore.email
  //       break
  //     case 'phone err':
  //       errMsg.value = errStore.phone
  //       break
  //   }
  //   pageIn('fail')
  // }
}

const register = async () => {
  // eslint-disable-next-line no-restricted-syntax
  for (const property in user) {
    if (user[property] === '') {
      msg.text = errStore[property]
      toFailPage('fail')
      return
    }
  }

  if (user.tnc === false) {
    msg.text = errStore.tnc
    toFailPage('fail')
    return
  }
  // eslint-disable-next-line no-useless-return
  if (block.value) return

  loading.value = true
  await registerServerResponse(user)
  loading.value = false
}

initGroup()
onMounted(() => {
  if (page.value === '') {
    toFailPage('404')
    return
  }
  user.language = language.value
  checkAvailbaility()
})

// msg page
provide('msg', msg)
provide('toFailPage', toFailPage)
provide('homepageFunc', home)
provide('tncFunc', tncFunc)

// testing

const testReg = (type = true) => {
  if (type === false) {
    toFailPage('fail')
  } else {
    toSuccessPage()
  }
}
</script>

<template>
  <div class="landing">
    <Subject />
    <!-- 轉v-show可以保留資料 -->
    <template v-if="page == 'register' && showMsgPage === false">
      <div class="landing-content">
        <div class="kv1">
          <img
            :src="`./images/kv1_${offerGroup}_${language}.png`"
            alt=""
            srcset=""
          />
        </div>
        <div class="kv2">
          <img
            :src="`./images/kv1_${offerGroup}_${language}.png`"
            alt=""
            srcset=""
          />
          <div class="kv2-hover-box">
            <a href="" target="_blank">
              <img :src="`./images/hover_${language}.png`" alt="" />
            </a>
          </div>
        </div>
      </div>

      <div class="register-box">
        <div class="phone">
          <div class="phone-text">{{ $t('register')['form']['phone'] }}</div>
          <input
            v-model="user.phone"
            class="register-box-h"
            type="text"
            maxlength="8"
            autocomplete="off"
            @input="vaildPhone"
          />
        </div>
        <div class="sms">
          <div>{{ $t('register')['form']['sms'] }}</div>
          <div class="sms-select register-box-h">
            <div
              class="sms-select-item"
              :class="user.language == 'tc' ? 'selected' : ''"
              @click="changeSMSLang('tc')"
            >
              <u>中文</u>&nbsp;
            </div>
            <div>|</div>
            <div
              class="sms-select-item"
              :class="user.language == 'en' ? 'selected' : ''"
              @click="changeSMSLang('en')"
            >
              &nbsp;<u>ENG</u>
            </div>
          </div>
        </div>
        <div class="submit">
          <div>&nbsp;</div>
          <div
            class="reg-btn register-box-h"
            :class="language == 'en' ? 'text_m3' : 'text_m2'"
            @click="register()"
          >
            {{ $t('register')['form']['submit'] }}
          </div>
        </div>
      </div>

      <div class="tnc">
        <div class="tnc-confirm">
          <div class="checkbox-round">
            <input
              id="tnc-checkbox"
              v-model="user.tnc"
              class="tnc-checkbox"
              type="checkbox"
            />
            <label for="tnc-checkbox"></label>
          </div>
          <div :class="language == 'en' ? 'text_s2' : ''">
            {{ $t('register')['form']['tnc_1'][0] }}
            <span class="text-underline" @click="tncFunc()">
              {{ $t('register')['form']['tnc_1'][1] }}</span
            >
            {{ $t('register')['form']['tnc_c'] }}
          </div>
        </div>

        <div class="tnc-confirm">
          <div class="checkbox-round">
            <input
              id="marketing-checkbox"
              v-model="user.marketing"
              class="marketing-checkbox"
              type="checkbox"
            />
            <label for="marketing-checkbox"></label>
          </div>
          <div :class="language == 'en' ? 'text_s2' : ''">
            {{ $t('register')['form']['tnc_2'][0] }}
            <span class="text-underline" @click="tncFunc()">
              {{ $t('register')['form']['tnc_2'][1] }}</span
            >
            {{ $t('register')['form']['tnc_2'][2] }}
          </div>
        </div>

        <div class="remark">{{ $t('register')['remark'] }}</div>
      </div>
    </template>

    <div v-if="page == 'public' && showMsgPage === false" class="bg-liner">
      <LoginPage />
    </div>
    <div v-show="showMsgPage === true" class="bg-liner">
      <MsgPage />
    </div>

    <TncPage v-if="showTnc">
      <div @click="tncFunc()">
        <img src="@/assets/close.png" alt="" />
      </div>
    </TncPage>
  </div>
</template>

<style scoped>
.landing {
  height: 100%;
  display: flex;
  flex-direction: column;
}
.landing-content {
  background-color: #fff;
  padding: 4rem 0 8rem;
}
.kv1 {
  padding-left: 18rem;
}

.kv2 {
  position: relative;
  padding: 2rem 18rem 0;
}
.kv2-hover-box {
  position: absolute;
  right: 18.5rem;
  top: 0;
  width: 65rem;
}

.register-box {
  display: flex;
  font-size: 12rem;
  color: #fff;
  padding: 0 18rem;
  margin: 4rem 0;
  height: 48rem;
}
.register-box > div {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 100%;
}
.register-box > div > div {
  text-align: left;
  height: 18rem;
}
.register-box-h {
  margin-top: auto;
  height: 28rem !important;
}

.phone {
  width: 50%;
}

.phone input {
  width: 100%;
  background-color: white;
  border: none;
}

.sms {
  margin: auto;
  padding: 0 2%;
}

.sms-select {
  display: flex;
  align-items: center;
  justify-content: center;
}

.submit {
  min-width: 15%;
  width: fit-content;
}

.reg-btn {
  color: var(--cdb);
  background-color: var(--cy);
  font-weight: bold;
  font-size: 15rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.tnc {
  font-size: 10rem;
  color: #fff;
}

.tnc-confirm {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  column-gap: 5px;
  margin-top: 1%;
  padding-left: 18rem;
  text-align: left;
}

.checkbox-round {
  position: relative;
}

.checkbox-round label {
  background-color: #fff;
  border-radius: 50%;
  cursor: pointer;
  left: 50%;
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 18px;
  height: 18px;
}

.checkbox-round label:after {
  border: 2px solid #0060d3;
  border-top: none;
  border-right: none;
  content: '';
  opacity: 0;
  position: absolute;
  top: 25%;
  left: 16%;
  transform: translate(-16%, -25%);
  transform: rotate(-45deg);
  width: 10px;
  height: 5px;
}

.checkbox-round input[type='checkbox'] {
  visibility: hidden;
}

.checkbox-round input[type='checkbox']:checked + label:after {
  opacity: 1;
}

.text-underline {
  text-decoration: underline;
}
.remark {
  padding-left: 18rem;
  text-align: left;
  margin: 12rem auto;
  white-space: pre-wrap;
  font-size: 6rem;
}

.selected {
  color: var(--cy);
}

.bg-liner {
  background: linear-gradient(
    0deg,
    #1077b3 2.28%,
    #197eb9 13.97%,
    #3492c9 33.45%,
    #5cb0e1 56.83%
  );
}
</style>
