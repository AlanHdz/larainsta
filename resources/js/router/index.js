import { createRouter, createWebHistory } from "vue-router";


import authRouter from '../modules/auth/router'
import feedRouter from '../modules/feed/router'
import profileRoute from '../modules/profile/router'
import isUnAuthenticatedGuard from '@/modules/auth/router/unauth-guard'


const routes = [
    {
        path: '',
        ...authRouter,
        beforeEnter: [isUnAuthenticatedGuard]
    },
    {
        path: '',
        ...feedRouter
    },
    {
        path: '',
        ...profileRoute
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;