<template>
    <div @click="alertaElegida = null">
        <div>
            <ul id="mapHeader">
                <li @click="filter = 0" :class="filter == 0 ? 'active' : '' ">Todas</li>
                <li @click="filter = 1" :class="filter == 1 ? 'active' : '' ">Encontradas</li>
                <li @click="filter = 2" :class="filter == 2 ? 'active' : '' ">Perdidas</li>
            </ul>
        </div>
        <BaseMap
            :allAlertas="filterAlertas"
            :userLocation="userLocation"
            @abrirResumen="elegirAlerta"
        />
        <!-- <GoogleMap
        :allAlertas="filterAlertas"
        :latitude= 13.7013266
        :longitude= -89.226622
        :title="'Titulo Marcador'"
        @abrirResumen="elegirAlerta"
        /> -->
        <transition name="slide-fade">
            <ResumenAlerta
            v-if="alertaElegida !== null"
            :alerta="alertaElegida"
            @cerrarResumen="alertaElegida = null"
            />
        </transition> 
    </div>
</template>
<script>
/* import GoogleMap from '../components/GoogleMap.vue'; */
import ResumenAlerta from '../components/ResumenAlerta.vue';
import BaseMap from '../components/BaseMap.vue';
import alertasServicio from '../servicios/alertasServicio';

export default {
    name: 'Buscar',
    components: {
        BaseMap,
        ResumenAlerta
        /* GoogleMap, */
    },
    computed:{
        filterAlertas: function() {
            if(this.filter == 1){
                //tipo 1 = encontradas
                const alertasPerdidas = this.alertas.filter(alerta => {
                    return alerta.id_tipoalerta == 1; 
                })
                return alertasPerdidas
            }else if(this.filter == 2){
                const alertasEncontradas = this.alertas.filter(alerta => {
                    return alerta.id_tipoalerta == 2; 
                })
                return alertasEncontradas
            }
            return this.alertas;
        }
    },
    beforeMount() {
        // Busco la ubicacion del usuario y la guardo en data para pasarsela al mapa
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                setUserLocation([position.coords.longitude, position.coords.latitude])
            });
        }else{
            this.userLocation = false
        }
        const setUserLocation = (lngLat) => {
            this.userLocation = lngLat
        }
    },
    mounted() {
        alertasServicio.todos()
            .then(res => {
                this.alertas = res;
            })
    },
    methods: {
        elegirAlerta: function(alerta){
            this.alertaElegida = null;
            setTimeout(() => this.alertaElegida = alerta, 100)
            
        }
    },
    data: function() {
        return{
            map: null,
            alertas: [],
            filter: 0,
            alertaElegida: null,

            userLocation: false,
        }
    }
}
</script>
<style scoped>
.slide-fade-enter-active {
  transition: all .25s ease;
}

.slide-fade-leave-active {
  transition: all .25s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateY(10px);
  opacity: 0;
}
    #mapHeader{
        margin: -1rem;
        margin-bottom: 0;
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        background: var(--primary);
    }    

    #mapHeader > li{
        color: #fff;
        padding: .5rem;
        border-radius: 4px;
    }

    #mapHeader .active{
        background: var(--light-primary);
    }
</style>