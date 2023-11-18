<script setup>
import { provide, watch, ref } from 'vue'
import { language } from '@/stores/language'
import Header from './components/header.vue'
import Loading from './components/loading.vue'

const loading = ref(false)

provide('loading', loading)

watch(
  language,
  (newValue, oldValue) => {
    loading.value = true
    setTimeout(() => {
      loading.value = false
    }, 200)
  },
  { immediate: true },
)
</script>

<template>
  <Header />
  <router-view></router-view>
  <Loading v-if="loading == true" />
</template>

<style scoped></style>
