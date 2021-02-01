import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import LandingPage from '../components/LandingPage.vue'
import Portfolio  from '../components/Portfolio.vue'
import Impressum from '../components/Impressum.vue'
import Solution from '../components/Solution.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    children: [
      {
        path: '',
        component: LandingPage
      },
      {
        path: 'portfolio',
        component: Portfolio
      },
      {
        path: 'impressum',
        component: Impressum
      },
  
    ]
  },
  {
    path: '/solution/:url',
    component: Solution
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  routes
})

export default router
