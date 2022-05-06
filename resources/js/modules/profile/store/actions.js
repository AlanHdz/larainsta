import api from '@/api/api'


export const getUserWithPosts = async({ commit }, username) => {
  try {
    const { data } = await api.get(`/api/v1/profile/${username}`);

    const { user, posts } = data

    commit('setProfile', { user, posts })

    return { ok: true }

  } catch (error) {
    const { errors } = error.response.data
    return { ok: false, message: errors }
  }
}