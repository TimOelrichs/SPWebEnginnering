import Vue from 'vue'
import VueRouter from 'vue-router'
import LandingPage from '../components/LandingPage.vue'
import Portfolio  from '../components/Portfolio.vue'
import Impressum from '../components/Impressum.vue'


Vue.use(VueRouter)

const routes = [
  
      {
        path: '/',
        component: LandingPage
      },
      {
        path: '/portfolio',
        component: Portfolio
      },
      {
        path: '/impressum',
        component: Impressum
      },
  
    ]


const router = new VueRouter({
  routes
})

export default router
