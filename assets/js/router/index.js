import Vue from 'vue'
import Router from 'vue-router'
import Notfound from '../components/Notfound'
import Dashboard from '../components/Dashboard'
import Search from '../components/Search'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            name: 'homepage',
            path: '/',
            component: Dashboard
        },
        {
            name: 'search-query',
            path: '/search?',
            component: Search
        },
        {
            name: 'notfound',
            path: '*',
            component: Notfound
        }
    ]
})