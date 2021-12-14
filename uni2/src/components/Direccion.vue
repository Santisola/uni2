<template>
    <div class="direccionBien">
        {{direccionBien}}
    </div>
</template>
<script>
export default {
    name:"Direccion",
    props:{
        lat: {required: true},
        lng: {required: true},
    },
    mounted() {
        const geocoder = new google.maps.Geocoder();
        const latLng = {
            lat: parseFloat(this.lat),
            lng: parseFloat(this.lng),
        }
        geocoder
            .geocode({ location: latLng })
            .then(res => {
                this.direccion = res.results[0]
            })
    },
    updated() {
        const geocoder = new google.maps.Geocoder();
        const latLng = {
            lat: parseFloat(this.lat),
            lng: parseFloat(this.lng),
        }
        geocoder
            .geocode({ location: latLng })
            .then(res => {
                this.direccion = res.results[0]
            })
    },
    computed:{
        direccionBien: function(){
            if(!this.direccion){
                return 'Cargando...'
            }
            let calle = '';
            let altura = '';
            let localidad = '';
            
            this.direccion.address_components.map(comp => {
                if(comp.types[0] == 'route'){
                    calle = comp.short_name
                }
                if(comp.types[0] == 'street_number'){
                    altura = comp.long_name
                }
                if(comp.types[0] == 'administrative_area_level_1'){
                    localidad = comp.short_name
                }
            })

            return calle + ' ' + altura + ', ' + localidad
        }
    },
    data() {
        return {
            direccion: '',
        }
    },
}
</script>
<style>
    .direccionBien{
        width: 100%;
    }
</style>