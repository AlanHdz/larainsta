import axios from 'axios'

const authApi = axios.create({
    baseURL: process.env.MIX_APP_URL || '',
})

authApi.interceptors.response.use(response => response, error => {
    if (error.response.status === 401) {
        
    }
    return Promise.reject(error)
})

authApi.interceptors.request.use((config) => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`
    }
    return config
})

export default authApi