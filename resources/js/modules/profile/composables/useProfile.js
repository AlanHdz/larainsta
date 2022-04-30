import { useStore } from "vuex"

const useProfile = () => {

    const store = useStore()

    const getUserWithPosts = async () => {
        const resp = await store.dispatch('profile/getUserWithPosts');
        return resp
    }

    return {
        getUserWithPosts
    }
}


export default useProfile