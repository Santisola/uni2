<template>
  <gmap-map
    :center="center"
    :zoom="14"
    style="width: calc(100% + 2rem); height: calc(100vh - 155px); margin: 0 -1rem;"
    :options="{
        streetViewControl: false,
        mapTypeControl: false,
        fullscreenControl: false,
        zoomControl: false,
    }"
  >
    <gmap-marker 
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :title="m.title.toString()"
      :clickable="true"
      :icon="m.tipoAlerta == 1 ? greenMarker : redMarker "
      @click="$emit('abrirResumen', m)"
    ></gmap-marker>

  </gmap-map>
</template>
<script>
  const redMarker = require('../assets/icons/red-marker.svg');
  const greenMarker = require('../assets/icons/green-marker.svg');
  export default {
    props: {
        latitude: Number,
        longitude: Number,
        title: String,
        allAlertas: Array,
    },
    mounted() {
      this.geolocate();
    },
    methods: {
      geolocate: function() {
        navigator.geolocation.getCurrentPosition(position => {
          this.center = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
        });
      },
    },
    computed:{
      markers: function(){
        let alertasMarkers = this.allAlertas.map(alerta =>{
          if(alerta.nombre){
            return {
              position: {lat: parseFloat(alerta.latitud), lng: parseFloat(alerta.longitud)},
              title: alerta.id_alerta,
              tipoAlerta: alerta.id_tipoalerta,
              imagenes: alerta.imagenes,
              nombre: alerta.nombre,
              fecha: alerta.fecha
            }
          }else{
            return {
              position: {lat: parseFloat(alerta.latitud), lng: parseFloat(alerta.longitud)},
              title: alerta.id_alerta,
              tipoAlerta: alerta.id_tipoalerta,
              imagenes: alerta.imagenes,
              nombre: alerta.nombre,
              fecha: alerta.fecha
            }
          }
        });

        return alertasMarkers
      }
    },
    data () {
      return {
        greenMarker: greenMarker,
        redMarker: redMarker,
        center: {lat: -34.615759, lng: -58.5033452},
      }
    },

  }
</script>