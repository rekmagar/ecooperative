import Vue from 'vue';
import VueRouter from 'vue-router';

import FYearComponent from './components/FYearComponent'
Vue.use(VueRouter)

const routes = [
    {
        path: '/fyear',
        component: FYearComponent
    },
    // {
    //     path: '/year',
    //     component: Bar
    // },
    //     {
    //     path: '/month',
    //     component: Bar
    // },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

// router.beforeEach((to, from, next) => {
//     const token = localStorage.getItem('token') || null
//     window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
//     next();
// })

export default router;