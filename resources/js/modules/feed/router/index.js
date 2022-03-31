import Navbar from '../layout/Navbar.vue'
import Feed from '../views/Feed.vue'

export default {

    path: '',
    component: Navbar,
    children: [
        {
            path: 'home',
            name: 'feed',
            component: Feed
        },
    ]

}