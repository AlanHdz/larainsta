import AuthLayout from '../layout/AuthLayout.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'

export default {

    path: '',
    component: AuthLayout,
    children: [
        {
            path: '',
            name: 'login',
            component: Login
        },
        {
            path: 'register',
            name: 'register',
            component: Register
        }
    ]

}