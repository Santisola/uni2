<template>
  <gmap-map
    :center="center"
    :zoom="16"
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
        title: String
    },
    data () {
      return {
        center: {lat: this.latitude, lng: this.longitude},
        markers: [
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