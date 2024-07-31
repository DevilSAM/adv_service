import axios from 'axios'
import { ElMessage } from 'element-plus'

const service = axios.create({
  headers: {
    Accept: 'application/json'
  },
  baseURL: window.location.origin
})

service.interceptors.request.use(
  config => {
    return config
  },
  error => {
    console.log(error)
    return Promise.reject(error)
  }
)

service.interceptors.response.use(
  response => response,
  error => {
    console.log('err: ' + error)
    if (error.response.status === 500) {
      const errMessage = error.response.data?.message
      ElMessage({
        message: `Во время выполнения операции произошла ошибка. Необходимо обратиться в службу технической поддержки пользователей. \n\n ${errMessage}`,
        type: 'error',
        showClose: true,
        duration: 0
      })
    }
    return Promise.reject(error)
  }
)

export default service
