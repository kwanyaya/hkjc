<script setup>
import { inject, ref, reactive } from 'vue'
// import { useRouter } from 'vue-router'
import { language } from '@/stores/language'
// import { useUser } from '@/stores/user'

// import Tnc from './tnc.vue'

const currentStatus = ref('register')

const errStore = inject('$t')('err')
const msg = inject('msg')
const toFailPage = inject('toFailPage')
const tncFunc = inject('tncFunc')
const loading = inject('loading')

const user = reactive({
  phone: '',
  language,
  tnc: false,
  marketing: false,
  currentStatus,
})

// const router = useRouter()
const block = ref(false)

const setRegister = () => {
  currentStatus.value = 'register'
}
const setLogin = () => {
  currentStatus.value = 'login'
}

const vaildPhone = () => {
  if (user.phone.length > 8) {
    user.phone = user.phone.substring(0, 8)
  }
  user.phone = user.phone.replace(/[^0-9]/g, '')
  if (user.phone.length > 0) {
    user.phone = `${parseInt(user.phone, 10)}`
  }
}

const login = () => {
  // const user = useUser()
  // const login_result = await user.PublicLogin({ phone: phone.value })
  // if (login_result) {
  //   router.push(`/user/${user.User.userinfo.uid}`)
  // }
}

const register = () => {
  if (user.tnc === false) {
    msg.text = errStore.tnc
    block.value = false
    toFailPage('fail')
    return
  }
  if (user.phone === '') {
    msg.text = errStore.phone
    block.value = false
    toFailPage('fail')
  }
  // const user = useUser()
  // const login_result = await user.PublicLogin({ phone: phone.value })
  // if (login_result) {
  //   router.push(`/user/${user.User.userinfo.uid}`)
  // }
}

const confirm = async () => {
  if (block.value) return
  block.value = true
  loading.value = true

  if (currentStatus.value === 'register') {
    register()
  } else if (currentStatus.value === 'login') {
    login()
  } else {
    toFailPage('404')
  }

  loading.value = false
}
</script>
<template>
  <div class="login-box">
    <div class="title">
      <img
        :src="`/images/login_${currentStatus}_${language}.png`"
        alt=""
        srcset=""
      />
      <div
        class="regOrLogin"
        :class="language == 'en' ? 'regOrLoginLen' : 'regOrLoginLtc'"
      >
        <div @click="setRegister"></div>
        <div @click="setLogin"></div>
      </div>
    </div>

    <div class="reg-area">
      <div class="content">
        <div class="phone">
          <div>{{ $t('login')['input_phone'] }}</div>
          <input
            v-model="user.phone"
            type="text"
            maxlength="8"
            autocomplete="off"
            @input="vaildPhone"
          />
        </div>

        <div v-if="currentStatus == 'register'" class="tnc">
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
              {{ $t('register')['form']['tnc_1'][0]
              }}<span class="text-underline" @click="tncFunc()">
                {{ $t('register')['form']['tnc_1'][1] }}</span
              >{{ $t('register')['form']['tnc_c'] }}
            </div>
          </div>

          <div class="tnc-confirm">
            <div class="checkbox-round">
              <input
                id="tnc-checkbox"
                v-model="user.marketing"
                class="tnc-checkbox"
                type="checkbox"
              />
              <label for="tnc-checkbox"></label>
            </div>
            <div :class="language == 'en' ? 'text_s2' : ''">
              {{ $t('register')['form']['tnc_2'][0]
              }}<span class="text-underline" @click="tncFunc()">
                {{ $t('register')['form']['tnc_2'][1] }}</span
              >{{ $t('register')['form']['tnc_2'][2] }}
            </div>
          </div>
        </div>
      </div>

      <div
        class="reg-btn reg-f"
        :class="language == 'en' ? 'text_m2' : 'text_m3'"
        @click="confirm()"
      >
        {{ $t('login')['submit'] }}
      </div>
    </div>
  </div>
</template>

<style scoped>
.login-box {
  font-size: 12rem;
  color: #fff;

  min-height: 420rem;
  display: flex;
  flex-direction: column;
}
.title {
  position: relative;
  width: 332rem;
  margin: 15rem 22rem;
}
.regOrLogin {
  position: absolute;
  height: 21%;
  width: 32%;
  bottom: 0;
  display: flex;
}

.regOrLogin > div {
  height: 100%;
  width: 50%;
}

.regOrLoginLtc {
  left: 14%;
}

.regOrLoginLen {
  width: 41%;
  left: 0;
}

.reg-area {
  padding: 0 45rem;
  text-align: left;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.phone input {
  width: 100%;
  background-color: white;
  border: none;
  height: 37rem;
  margin: 6rem auto 30rem;
}

.tnc {
  font-size: 11rem;
  color: #fff;
}

.tnc-confirm {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  column-gap: 5px;
  margin-top: 1%;
  height: 66%;
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
