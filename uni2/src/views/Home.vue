<template>
	<div class="home">
		<h1>Hola, {{usuario.nombre}}</h1>
		<MiniLoader v-if="isLoading" />
		<SliderAlertas v-else
		titulo="Mascotas perdidas por tu zona"
		:alertas=alertasPerdidas
		:tipo="2"
		/>
        <CardAnuncio :anuncio="anuncio" />
		<MiniLoader v-if="isLoading" />
		<SliderAlertas
		v-else
		titulo="Mascotas encontradas por tu zona"
		:alertas=alertasEncontradas
		:tipo="1"
		/>
	</div>
</template>

<script>
// @ is an alias to /src
import SliderAlertas from '../components/SliderAlertas';
import CardAnuncio from '../components/CardAnuncio.vue';
import alertasServicio from '../servicios/alertasServicio'
import authServicio from '../servicios/authServicio';
import MiniLoader from '../components/MiniLoader.vue';

export default {
  name: 'Home',
  components: {
	  SliderAlertas,
      CardAnuncio,
	  MiniLoader
  },
  mounted() {
	  this.isLoading = true;

	  this.usuario = authServicio.getUsuario();
	  
	  alertasServicio.todos()
		.then(data => {
			this.alertas = data;
			setTimeout(() => {
				this.isLoading = false
			}, 750)
		})
  },
  computed: {
	  alertasPerdidas: function() {
		  const perdidas = this.alertas.filter(alerta => {
			  return alerta.id_tipoalerta == 2;
		  });
		  return perdidas;
	  },
	  alertasEncontradas: function() {
		  const perdidas = this.alertas.filter(alerta => {
			  return alerta.id_tipoalerta == 1;
		  });
		  return perdidas;
	  },
  },
  data: function(){
	return{
		usuario: {},
		isLoading: false,
		alertas: [],
        anuncio: {
            img: 'https://dummyimage.com/350x125/777/eee',
            titulo: '¡Vení a una nueva jornada de adopción!',
            texto: 'El miércoles en Puppies de Av. Cabildo se hará una nueva jornada de adopción. Podrás acercarte desde las 10:00hs hasta las 18:00hs y bla blablabla blabla'
        }
	}
  },
}
</script>
<style scoped>
h1{
    margin: 1rem 0;
    font-size: 1.5rem;
}
</style>