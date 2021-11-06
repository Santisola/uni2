import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Buscar from '../views/Buscar.vue'
import Publicar from '../views/Publicar.vue'
import Alertas from '../views/Alertas.vue'
import Perfil from '../views/Perfil.vue'
import PublicarPerdida from '../views/PublicarPerdida.vue'
import DetalleAlerta from '../views/DetalleAlerta.vue'
import Login from '../views/Login.vue'
import Registro from '../views/Registro.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/buscar',
    name: 'Buscar',
    component: Buscar
  },
  {
    path: '/publicar',
    name: 'Publicar',
    component: Publicar
  },
  {
    path: '/publicar/perdida',
    name: 'Publicar Perdida',
    component: PublicarPerdida
  },
  {
    path: '/alertas',
    name: 'Alertas',
    component: Alertas
  },
  {
    path: '/alertas/:id',
    name: 'DetalleAlerta',
    component: DetalleAlerta
  },
  {
    path: '/perfil',
    name: 'Perfil',
    component: Perfil
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/registro',
    name: 'Registro',
    component: Registro
  },
]

const router = new VueRouter({
  routes
})

export default router
