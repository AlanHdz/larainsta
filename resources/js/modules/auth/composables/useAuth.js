import { useStore } from "vuex"

const useAuth = () => {

  const store = useStore()

  const loginUser = async(user) => {
    console.log(user);
  }

  const createUser = async(user) => {
    console.log(user);
  }

  return {
    loginUser,
    createUser
  }
}

export default useAuth