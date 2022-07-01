<template>
    <a
    v-if="alerta.tipoAlerta"
    href="#"
    class="container"
    @click="$router.push('/alertas/' + alerta.id_alerta + '?from=buscar')"
    >
        <div class="imgContainer">
            <ImagenesAlerta :imgs="alerta.imagenes" :principal="true" />
        </div>
        <div class="info">
            <div class="info-header">
                <h1 v-if="alerta.nombre">{{alerta.nombre}}</h1>
                <span v-if="!alerta.id_tipoalerta" class="evento">Evento</span>
                <span :class="alerta.id_tipoalerta == 1 ? 'encontrada' : 'perdida'">{{tipoAlerta}}</span>
            </div>
            <ul>
                <li>{{fechaBien}}</li>
                <li><Direccion :lat="alerta.latitud" :lng="alerta.longitud" /></li>
            </ul>
        </div>
    </a>
    <a
    v-else
    href="#"
    class="container"
    @click="$router.push('/alertas/' + alerta.id_alerta + '?from=buscar')"
    >
        <div class="imgContainer">
            <ImagenesAlerta :imgs="alerta.id_tipoalerta ? alerta.imagenes : alerta.imagen" :principal="true" />
        </div>
        <div class="info">
            <div class="info-header">
                <h1 v-if="alerta.nombre">{{alerta.nombre}}</h1>
                <span v-if="!alerta.id_tipoalerta" class="evento">Evento</span>
                <span v-else :class="alerta.id_tipoalerta == 1 ? 'encontrada' : 'perdida'">{{tipoAlerta}}</span>
            </div>
            <ul>
                <li>{{fechaBien}}</li>
                <li><Direccion :lat="alerta.latitud" :lng="alerta.longitud" /></li>
            </ul>
        </div>
    </a>
</template>
<script>
import ImagenesAlerta from './ImagenesAlerta.vue';
import Direccion from './Direccion.vue';


export default {
    name: 'ResumenAlerta',
    components:{
        ImagenesAlerta,
        Direccion
    },
    props:{
        alerta: Object
    },
    computed:{
        tipoAlerta: function(){
            return this.alerta.tipoAlerta == 1 ? 'Encontrada' : 'Perdida';
        },
        fechaBien: function(){
            if(!this.alerta.id_tipoalerta){
                let fecha = this.alerta.desde.split(' ')[0].split('-');
                let hora = this.alerta.desde.split(' ')[1].split(':')
                return `${fecha[2]}/${fecha[1]}/${fecha[0]}, a las ${hora[0]}:${hora[1]}hs`;
            }
            
            if(this.alerta.fecha == null){
                return 'No se sabe';
            } 
            
            let fecha = this.alerta.fecha.split('-');
            return fecha[2] + ' / ' + fecha[1] + ' / ' + fecha[0]; 
        },
    }
}
</script>
<style scoped>
    .container{
        display: flex;
        align-items: center;
        background: #fff;
        width: 90%;
        border-radius: 14px;
        position: absolute;
        bottom: 100px;
        box-shadow: 0px 2px 16px -10px rgba(119, 119, 119, 0.5);
        z-index: 3;
    }
    
    .imgContainer{
        width: 75px;
        height: 75px;
    }

    .info{
        padding: .5rem;
        width: 100%;
    }

    .info-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: .5rem;
    }

    .info-header h1{
        font-style: normal;
        font-weight: 800;
        font-size: 16px;
        line-height: 24px;
        margin-right: .5rem;
    }

    .info-header span{
        color: #fff;
        height: fit-content;
        padding: .5rem;
        border-radius: 25px;
        font-size: 10px;
    }

    .info-header .perdida{
        background: var(--perdida);
    }

    .info-header .encontrada{
        background: var(--encontrada);
    }

    .info-header .evento{
        background: var(--secondary);
    }

    li{
        font-size: 14px;
    }
</style>