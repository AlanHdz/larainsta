import { createStore } from 'vuex'
import auth from '@/modules/auth/store'
import feed from '@/modules/feed/store';

const store = createStore({
  modules: {
    auth,
    feed
  },
})

export default store