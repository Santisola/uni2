<template>
    <div v-if="isLoading" class="direccionBien">
        Cargando...
    </div>
    <div v-else class="direccionBien">
        {{direccion}}
    </div>
</template>
<script>
import {HERE_API_KEY} from '../constantes/index.js'

export default {
    name:"Direccion",
    props:{
        lat: {required: true},
        lng: {required: true},
    },
    async mounted() {
        this.platform = new H.service.Platform({
            apikey: this.apikey
        });

        this.service = this.platform.getSearchService();

        this.isLoading = true
        await this.service.reverseGeocode({
            at: `${this.lat},${this.lng}`
        }, (res) => {
            const resItem = res.items[0];
            if(resItem.address.street){
                this.direccion = `${resItem.address.street } ${resItem.address.houseNumber ?? ''}`;
            }else{
                this.direccion = resItem.address.label
            }
            this.isLoading = false;
        })
    },
    data() {
        return {
            isLoading: false,
            
            direccion: '',
            platform: null,
            service: null,
            apikey: HERE_API_KEY,
        }
    },
}
</script>
<style>
    .direccionBien{
        width: 100%;
    }
</style>