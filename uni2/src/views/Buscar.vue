<template>
    <div>
        <h1>Buscar</h1>
        <GoogleMap :latitude= 13.7013266 :longitude= -89.226622 :title="'Titulo Marcador'" />
    </div>
</template>
<script>
import GoogleMap from '../components/GoogleMap.vue';

export default {
    name: 'Buscar',
    components: {
        GoogleMap
    },
    data: function() {
        return{
            map: null
        }
    }
}
</script>
<style>
    
</style>