<script setup>
import { language } from '@/stores/language'
</script>

<template>
  <div class="subject" :class="language == 'en' ? 'text-bold' : 'text-bold'">
    <img :src="`./images/kv_${language}.png`" alt="" />
  </div>
</template>

<style scoped>
.subject {
  white-space: nowrap;
}

.subject-t1 {
  color: var(--cy);
}
.subject-t2 {
}
.subject-t3 {
  position: relative;
}

.subject-t3 {
  width: 95%;
  margin: 0 auto;
  text-align: center;
  /* border-bottom: 1px solid #fff;  */
  border-bottom: 1px solid rgba(200, 200, 200, 0.7);
  line-height: 0.1em;
  /* margin:10px 0 20px;  */
  margin-top: 2%;
}
.subject-t3 span {
  background: var(--cr);
  padding: 0 10px;
}
</style>
