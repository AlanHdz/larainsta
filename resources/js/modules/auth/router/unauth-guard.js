import store from '@/store'

const isUnAuthenticatedGuard = async (to, from, next) => {
    
    const status = await store.getters['auth/currentState']

    if (status == 'not-authenticated') next()
    else next({ name: 'home' })
}

export default isUnAuthenticatedGuard