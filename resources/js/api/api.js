import axios from 'axios'

const authApi = axios.create({
    baseURL: process.env.MIX_APP_URL || '',
})

export default authApi