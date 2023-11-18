import { ref, watch } from 'vue'
import router from '@/router'
import { adminLogin } from '@/api/admin'

export const useAdminStore = () => {
  const token = ref(window.localStorage.getItem('token_sc') || '')
  const userlevel = ref(window.localStorage.getItem('userlevel') || '')

  const Login = async (data) => {
    const res = await adminLogin(data)
    if (res.data.status == 'success') {
      setUserLevel(res.data.role)
      setToken(res.data.jwt)

      router.push({ path: '/admin/home/' })
      return true
    }
    if (res.data.status == 'fail') {
      return res
    }
  }

  const setUserLevel = (level) => {
    userlevel.value = level
  }

  const setToken = (val) => {
    token.value = val
  }

  const ClearStorage = async () => {
    token.value = ''
    userlevel.value = ''
    localStorage.clear()
    router.push({ path: '/admin/login' })
  }

  watch(
    () => token.value,
    () => {
      window.localStorage.setItem('token_sc', token.value)
    },
  )
  watch(
    () => userlevel.value,
    () => {
      window.localStorage.setItem('userlevel', userlevel.value)
    },
  )

  return {
    token,
    Login,
    userlevel,
    ClearStorage,
  }
}
