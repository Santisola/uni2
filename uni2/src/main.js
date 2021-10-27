import Vue from 'vue'
import App from './App.vue'
import router from './router'
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyCB1vgJTtSwoyyY09FydpnfBfBGdRO5tgE",
    libraries: 'places',
  },
});

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
