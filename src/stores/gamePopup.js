import { ref } from 'vue'

export const currentPopup = ref('')

export const SetCurrentPopup = (_currentPopup) => {
  if (currentPopup.value === _currentPopup) {
    currentPopup.value = ''
    return
  }
  currentPopup.value = _currentPopup
}
