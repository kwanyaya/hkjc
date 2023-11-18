import { ref, watch } from 'vue'

export const language = ref(window.localStorage.getItem('language') || 'tc')

export const setLanguage = (_lang) => {
  language.value = _lang
  window.localStorage.setItem('language', _lang)
}

watch(language, (newLang) => {
  window.localStorage.setItem('language', newLang)
})
