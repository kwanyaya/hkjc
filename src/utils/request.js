import axios from 'axios'
// import store from '../store/index.js'

const baseURL = import.meta.env.VITE_BASEAPI

// export default {
export const authHeader = axios.create({
  baseURL,
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
})

export const dataHeader = () => {
  // let jwt = store.state.adminAuthStore.jwt
  const jwt = 'demojwt'
  const datApi = axios.create({
    baseURL,
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      Authorization: `Bearer ${jwt}`,
    },
  })
  return datApi
}
