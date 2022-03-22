<template>
    <a
    href="#"
    class="container"
    @click="$router.push('/alertas/' + alerta.title + '?from=buscar')"
    >
        <div class="imgContainer">
            <ImagenesAlerta :imgs="alerta.imagenes" :principal="true" />
        </div>
        <div class="info">
            <div class="info-header">
                <h1 v-if="alerta.nombre">{{alerta.nombre}}</h1>
                <span :class="alerta.tipoAlerta == 1 ? 'encontrada' : 'perdida'">{{tipoAlerta}}</span>
            </div>
            <ul>
                <li>{{fechaBien}}</li>
                <!-- <li><Direccion :lat="alerta.position.lat" :lng="alerta.position.lng" /></li> -->
            </ul>
        </div>
    </a>
</template>
<script>
import ImagenesAlerta from './ImagenesAlerta.vue';
//import Direccion from './Direccion.vue';


export default {
    name: 'ResumenAlerta',
    components:{
        ImagenesAlerta,
        //Direccion
    },
    props:{
        alerta: Object
    },
    computed:{
        tipoAlerta: function(){
            return this.alerta.tipoAlerta == 1 ? 'Encontrada' : 'Perdida';
        },
        fechaBien: function(){
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

    li{
        font-size: 14px;
    }
</style>