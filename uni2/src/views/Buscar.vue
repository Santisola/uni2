<template>
    <div>
        <div>
            <ul id="mapHeader">
                <li @click="filter = 0" :class="filter == 0 ? 'active' : '' ">Todas</li>
                <li @click="filter = 1" :class="filter == 1 ? 'active' : '' ">Encontradas</li>
                <li @click="filter = 2" :class="filter == 2 ? 'active' : '' ">Perdidas</li>
            </ul>
        </div>
        <GoogleMap :allAlertas="filterAlertas" :latitude= 13.7013266 :longitude= -89.226622 :title="'Titulo Marcador'" />
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
            filter: 0
        }
    }
}
</script>
<style scoped>
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