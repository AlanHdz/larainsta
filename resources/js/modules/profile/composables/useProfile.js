import { useStore } from "vuex"
import { computed } from "vue"

const useProfile = () => {

    const store = useStore()

    const getUserWithPosts = async (username) => {
        const resp = await store.dispatch('profile/getUserWithPosts', username);
        return resp
    }

    return {
        getUserWithPosts,
        posts: computed(() => store.getters["profile/getUserPosts"]),
        user: computed(() => store.getters["profile/getUserProfile"]),
    }
}


export default useProfile