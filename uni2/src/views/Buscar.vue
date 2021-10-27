<template>
    <div>
        <h1>Buscar</h1>
        <GoogleMap :allAlertas="alertas" :latitude= 13.7013266 :longitude= -89.226622 :title="'Titulo Marcador'" />
    </div>
</template>
<script>
import GoogleMap from '../components/GoogleMap.vue';
import alertasServicio from '../servicios/alertasServicio'

export default {
    name: 'Buscar',
    components: {
        GoogleMap
    },
    mounted() {
        alertasServicio.todos()
            .then(res => {
                this.alertas = res;
            })
    },
    data: function() {
        return{
            map: null,
            alertas: [],
        }
    }
}
</script>
<style>
    
</style>