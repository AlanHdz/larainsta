import Navbar from '@/layouts/Navbar.vue'
import Profile from '../views/Profile.vue'
import Settings from '../views/Settings.vue'
import isAuthenticatedGuard from '@/modules/auth/router/auth-guard'

export default {

    path: '',
    component: Navbar,
    children: [
        {
            beforeEnter: [isAuthenticatedGuard],
            path: '/:username',
            name: 'profile',
            component: Profile
        },
        {
            beforeEnter: [isAuthenticatedGuard],
            path: '/settings',
            name: 'settings',
            component: Settings
        },
    ]

}