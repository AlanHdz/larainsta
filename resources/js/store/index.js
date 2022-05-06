import { createStore } from 'vuex'
import auth from '@/modules/auth/store'
import feed from '@/modules/feed/store';
import profile from '@/modules/profile/store'

const store = createStore({
  modules: {
    auth,
    feed,
    profile
  },
})

export default store