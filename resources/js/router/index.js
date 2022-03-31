import { createRouter, createWebHistory } from "vue-router";


import authRouter from '../modules/auth/router'
import feedRouter from '../modules/feed/router'


const routes = [
    {
        path: '',
        ...authRouter
    },
    {
        path: '',
        ...feedRouter
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;