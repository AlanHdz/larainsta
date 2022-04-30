import api from '@/api/api'


export const createUser = async({ commit }, user) => {
    const { name, username, email, password, password_confirmation } = user
    try {
        const { data } = await api.post('/api/v1/register', { name, username, email, password, password_confirmation })
        const { user, token, message } = data
        
        commit('loginUser', { user, token } )

        return { ok: true }
    } catch (error) {
        const { errors } = error.response.data
        return { ok: false, message: errors }
    }
}

export const loginUser = async({ commit }, user) => {
    const { email, password } = user
    try {
        const { data } = await api.post('/api/v1/login', { email, password })

        const { user, token, message } = data

        commit('loginUser', { user, token })

        return { ok: true }

    } catch (error) {
        const { errors } = error.response.data;
        return { ok: false, message: errors }
    }
}

export const checkAuthentication = async({ commit }) => {
    const token = localStorage.getItem('token')

    if (!token) {
        commit('logout')
        return { ok: false, message: 'Not found token' }
    }

    try {
        const { data } = await api.post(`/api/v1/refresh`)

        const user = {
            username: data.user.name,
            email: data.user.email,
            name: data.user.name
        }

        if (data.token) {
            const { token } = data
            commit('loginUser', { user, token })
        } else {
            commit('loginUser', { user })
        }

        return { ok: true }

    } catch (error) {
        commit('logout')
        return { ok: false, message: 'Not found token' }
    }

}