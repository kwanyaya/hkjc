import service from '@/utils/admin_request'

export const adminLogin = (data) => {
  return service({
    url: '/admin/login.php',
    method: 'post',
    data,
  })
}

export const userInfo = (data) => {
  return service({
    url: '/admin/get_user_info.php',
    method: 'post',
    data,
  })
}
export const gameUpdate = (data) => {
  return service({
    url: '/admin/game_update.php',
    method: 'post',
    data,
  })
}
