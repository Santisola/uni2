import authServicio from '../servicios/authServicio'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Buscar from '../views/Buscar.vue'
import Publicar from '../views/Publicar.vue'
import Alertas from '../views/Alertas.vue'
import Perfil from '../views/Perfil.vue'
import PublicarPerdida from '../views/PublicarPerdida.vue'
import PublicarEncontrada from '../views/PublicarEncontrada.vue'
import DetalleAlerta from '../views/DetalleAlerta.vue'
import DetalleEvento from '../views/DetalleEvento.vue'
import EditarAlerta from '../views/EditarAlerta.vue'
import Login from '../views/Login.vue'
import Registro from '../views/Registro.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    meta:{
        requiresAuth: true,
    },
    component: Home,
  },
  {
    path: '/buscar',
    name: 'Buscar',
    meta:{
        requiresAuth: true,
    },
    component: Buscar,
  },
  {
    path: '/publicar',
    name: 'Publicar',
    meta:{
        requiresAuth: true,
    },
    component: Publicar,
  },
  {
    path: '/publicar/perdida',
    name: 'Publicar Perdida',
    meta:{
        requiresAuth: true,
    },
    component: PublicarPerdida,
  },
  {
    path: '/publicar/encontrada',
    name: 'Publicar Encontrada',
    meta:{
        requiresAuth: true,
    },
    component: PublicarEncontrada,
  },
  {
    path: '/alertas',
    name: 'Alertas',
    meta:{
        requiresAuth: true,
    },
    component: Alertas,
  },
  {
    path: '/alertas/:id',
    name: 'DetalleAlerta',
    meta:{
        requiresAuth: true,
    },
    component: DetalleAlerta,
  },
  {
    path: '/eventos/:id',
    name: 'DetalleEvento',
    meta:{
        requiresAuth: true,
    },
    component: DetalleEvento,
  },
  {
    path: '/alertas/editar/:id',
    name: 'EditarAlerta',
    meta:{
        requiresAuth: true,
    },
    component: EditarAlerta,
  },
  {
    path: '/perfil',
    name: 'Perfil',
    meta:{
        requiresAuth: true,
    },
    component: Perfil,
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
  {
    path: '*',
    meta:{
      requiresAuth: true,
    },
    component: Home
  },
]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(ruta => ruta.meta.requiresAuth)) {
    if (authServicio.estaAutenticado()) {
      next();
    } else {
      next({ name: "Login" });
    }
  } else {
    next();
  }
});

export default router
