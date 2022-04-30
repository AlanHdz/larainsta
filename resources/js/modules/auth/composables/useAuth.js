import { computed } from "vue"
import { useStore } from "vuex"

const useAuth = () => {

  const store = useStore()

  const loginUser = async(user) => {
    const resp = await store.dispatch('auth/loginUser', user)
    return resp
  }

  const createUser = async(user) => {
    const resp = await store.dispatch('auth/createUser', user)
    return resp
  }

  const checkAuthStatus = async () => {
    const resp = await store.dispatch('auth/checkAuthentication')
    return resp
  }

  return {
    loginUser,
    createUser,
    checkAuthStatus,
    currentUser: computed(() => store.getters['auth/currentUser']),
    authStatus: computed(() => store.getters['auth/currentState'])
  }
}

export default useAuth