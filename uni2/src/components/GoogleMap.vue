<template>
  <gmap-map
    :center="center"
    :zoom="14"
    style="width: calc(100% + 2rem); height: calc(100vh - 141px); margin: 0 -1rem;"
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
      :title="m.title"
      :clickable="true"
      @click="center=m.position"
    ></gmap-marker>

  </gmap-map>
</template>
<script>
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
              title: alerta.nombre + ', ' + alerta.especie
            }
          }else{
            return {
              position: {lat: alerta.latitud, lng: alerta.longitud},
              title: alerta.especie + ', ' + alerta.raza
            }
          }
        });

        return alertasMarkers
      }
    },
    data () {
      return {
        center: {lat: -34.615759, lng: -58.5033452},
        oldMarkers: [
            {
                position: {lat: this.latitude, lng: this.longitude},
                title: this.title
            },
            {
                position: {lat: 13.7005299, lng:-89.226588},
                title: this.title
            },
            {
                position: {lat: 13.7005299, lng:-89.228888},
                title: this.title
            },
        ]
      }
    },

  }
</script>