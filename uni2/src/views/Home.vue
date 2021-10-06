<template>
	<div class="home">
		<h1>Hola, {{nombre}}</h1>
		<SliderAlertas
		titulo="Mascotas perdidas por tu zona"
		:alertas=alertasPerdidas
		:tipo="1"
		/>
        <CardAnuncio :anuncio="anuncio" />
		<SliderAlertas
		titulo="Mascotas perdidas por tu zona"
		:alertas=alertasPerdidas
		:tipo="2"
		/>
	</div>
</template>

<script>
// @ is an alias to /src
import SliderAlertas from '../components/SliderAlertas';
import CardAnuncio from '../components/CardAnuncio.vue'

export default {
  name: 'Home',
  components: {
	  SliderAlertas,
      CardAnuncio
  },
  data: function(){
	return{
		nombre: 'Juan Carlos',
		alertasPerdidas: [
			{
				img: 'https://dummyimage.com/150x100/ccc/777',
				nombre: 'Jano',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Macho',
				raza: 'Ovejero Alemán'
			},
			{
				img: 'https://dummyimage.com/150x100/ddd/777',
				nombre: 'Dexter',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Macho',
				raza: 'Mestizo'
			},
			{
				img: 'https://dummyimage.com/150x100/bbb/777',
				nombre: 'Helena',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Hembra',
				raza: 'Bulldog Francés'
			},
            {
				img: 'https://dummyimage.com/150x100/999/777',
				nombre: 'Luna',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Hembra',
				raza: 'Raza desconocida'
			},
		],
        alertasEncontradas: [
			{
				img: 'https://dummyimage.com/150x100/ccc/777',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Hembra',
				raza: 'Raza desconocida'
			},
			{
				img: 'https://dummyimage.com/150x100/ddd/777',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Macho',
				raza: 'Caniche Toy'
			},
			{
				img: 'https://dummyimage.com/150x100/bbb/777',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Macho',
				raza: 'Raza desconocida'
			},
            {
				img: 'https://dummyimage.com/150x100/999/777',
				fecha: '12/07/2020',
				direccion: 'Malabia 1330',
				sexo: 'Hembra',
				raza: 'Raza desconocida'
			},
		],
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