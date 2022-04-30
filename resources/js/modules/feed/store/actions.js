import api from '@/api/api';


export const getPostsFeed = async ({ commit }) => {
    try {
        const { data } = await api.get('/api/v1/feed')
        const { posts } = data
        commit('getPosts', { posts })

        return { ok: true }
    } catch (error) {
        const { errors } = error.response.data
        return { ok: false, message: errors }
    }
}

export const deletePost = async ({ commit }, postId) => {
    try {
        const { data } = await api.delete(`/api/v1/posts/${postId}`)
        const { message } = data

        commit('removePost', postId);

        return { ok: true, message: message }

    } catch (error) {
        const { message } = error.response.data
        return { ok: false, message: message }
    }
}