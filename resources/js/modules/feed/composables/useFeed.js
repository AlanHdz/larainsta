import { computed } from "vue"
import { useStore } from "vuex"


const useFeed = () => {

    const store = useStore()

    const getPosts = async () => {
        const resp = await store.dispatch("feed/getPostsFeed")
        return resp
    }

    const deletePostComposable = async (postId) => {
        const resp = await store.dispatch("feed/deletePost", postId);
        return resp
    }

    return {
        getPosts,
        deletePostComposable,
        posts: computed(() => store.getters["feed/getPosts"])
    }
}

export default useFeed