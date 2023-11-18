import service from '@/utils/request'

export const availability = (data) => {
  return service({
    url: '/user/availability.php',
    method: 'post',
    data,
  })
}
export const register = (data) => {
  return service({
    url: '/user/register.php',
    method: 'post',
    data,
  })
}
export const postPublicRegister = (data) => {
  return service({
    url: '/user/public_register.php',
    method: 'post',
    data,
  })
}
export const login = (data) => {
  return service({
    url: '/user/login.php',
    method: 'post',
    data,
  })
}

// export const cr = (data) => {
//   return service({
//     url: '/user/public.php',
//     method: 'post',
//     data,
//   })
// }
// export const phone_login = (data) => {
//   return service({
//     url: '/user/phone_login.php',
//     method: 'post',
//     data,
//   })
// }
