<template>
	<div class="home">
		<h1><div>Hola, {{usuario.nombre}} <img src="../assets/imago-amarillo.svg" alt="Logo Unidos"></div></h1>
		<MiniLoader v-if="isLoading" />
		<SliderAlertas 
		v-else-if="alertasPerdidas.length > 0"
		titulo="Mascotas perdidas por tu zona"
		:alertas="alertasPerdidas"
		:tipo="2"
		/>
        
		<SliderAlertas
		v-if="!isLoading && alertasEncontradas.length > 0"
		titulo="Mascotas encontradas por tu zona"
		:alertas="alertasEncontradas"
		:tipo="1"
		/>

		<CardAnuncio :anuncio="anuncio" />

		<MiniLoader v-if="isLoading" />
		<SliderAlertas
		v-else-if="reencontradas.length > 0"
		titulo="¡Mascotas reunidas con sus familias!"
		:alertas="reencontradas"
		/>
		
		<SliderEventos 
		v-if="!isLoading && eventos.length > 0"
		titulo="¡Enterate de los eventos que tenés cerca!"
		:alertas="eventos"
		/>
	</div>
</template>

<script>
// @ is an alias to /src
import SliderAlertas from '../components/SliderAlertas';
import SliderEventos from '../components/SliderEventos';
import CardAnuncio from '../components/CardAnuncio.vue';
import alertasServicio from '../servicios/alertasServicio'
import eventosServicio from '../servicios/eventosServicio'
import authServicio from '../servicios/authServicio';
import MiniLoader from '../components/MiniLoader.vue';

export default {
  name: 'Home',
  components: {
	  SliderAlertas,
	  SliderEventos,
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

	  alertasServicio.reencontradas()
		.then(data => {
			this.reencontradas = data;
			setTimeout(() => {
				this.isLoading = false
			}, 750)
		})

	  eventosServicio.todos()
		.then(data => {
			this.eventos = data;
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
		reencontradas: [],
		eventos: [],
        anuncio: {
            img: 'adopcion-puppies.jpg',
            titulo: '¡Vení a una nueva jornada de adopción!',
            texto: 'El miércoles en Puppies de Av. Cabildo se hará una nueva jornada de adopción. Podrás acercarte desde las 10:00hs hasta las 18:00hs y bla blablabla blabla'
        }
	}
  },
}
</script>
<style scoped>
h1{
    margin: -1rem;
    margin-bottom: 0;
    padding: 0.5rem 1rem;
    padding-bottom: 0;
    font-size: 1.5rem;
    background: #FFC800;
}

h1::after {
    content: "";
    display: block;
    height: 10px;
    background: #f6f6f6;
    margin: 0 -1rem;
    margin-top: 0.5rem;
    border-radius: 16px 16px 0 0;
    width: calc(100% + 2rem);
}
h1 div{
	display: flex;
	justify-content: space-between;
	align-items: center;
}

h1 div img{
	height: 40px;
}
</style>