import { authHeader } from '@/request/request'

// import mockData from '@/mock/data.json'

const reqHeader = async (_data) => {
  if (import.meta.env.VITE_USE_MOCK === 'false') {
    return authHeader(_data)
  }
  const mockData = await getMockData()
  return Promise.resolve(mockResult(mockData[_data.data.type]))
}

const getMockData = async () => {
  let mockData = {}
  console.log('user :: trigger mock data')
  if (import.meta.env.VITE_USE_MOCK) {
    mockData = await import('@/mock/data.json')
  }
  return mockData
}

const mockResult = (_res) => {
  return {
    data: _res,
  }
}

export const availability = (data) => {
  return reqHeader({
    url: 'demo.php',
    method: 'post',
    data,
  })
}

export const login = (data) => {
  return reqHeader({
    url: 'demo.php',
    method: 'post',
    data,
  })
}
