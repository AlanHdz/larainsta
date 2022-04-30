import Navbar from '@/layouts/Navbar.vue'
import Home from '../views/Home.vue'
import isAuthenticatedGuard from '@/modules/auth/router/auth-guard'

export default {

    path: '',
    component: Navbar,
    children: [
        {
            beforeEnter: [isAuthenticatedGuard],
            path: 'home',
            name: 'home',
            component: Home
        },
    ]

}