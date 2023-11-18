<script setup>
import { language } from '@/stores/language'

const homePage = () => {
  location.reload()
}
</script>

<template>
  <div class="nav-bar">
    <div class="hkjc" @click="homePage()">
      <img :src="`./images/logo_${language}.png`" alt="" />
    </div>
    <select v-model="language">
      <option value="tc">&nbsp;中文&nbsp;</option>
      <option value="en">&nbsp;EN&nbsp;</option>
    </select>
  </div>
</template>

<style scoped>
.nav-bar {
  width: 100%;
  position: absolute;
  top: 0;
  padding: 8rem 17rem 0;
  height: 68rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 10;
}
.hkjc {
  width: 50%;
}

select {
  width: 18%;
  text-align: left;
  outline: unset;
  border: unset;
  font-family: 'Noto Sans TC', 'Noto Sans';
  color: var(--cdb);

  background-color: #fff;
  padding: 0.5% 2.5%;
  border-radius: 50px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('@/assets/arrow.png');
  background-size: 12%;
  background-repeat: no-repeat;
  background-position-x: 85%;
  background-position-y: 55%;
  margin-bottom: 1.5%;
}
</style>
