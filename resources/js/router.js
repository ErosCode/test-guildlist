import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router)

import Home from './views/home';
import charEditPage from './views/charEdit';

const routes = [
    {
        path: '/char/detail/:id',
        name: "detail",
        component: charEditPage,
        props: true,
    },
    {
        path: '/',
        name: 'home',
        component: Home
    },
]

export default new Router({
    mode: 'history',
    routes
})