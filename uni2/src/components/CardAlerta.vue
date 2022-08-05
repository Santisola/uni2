<template>
    <div class="card">
        <div class="cardImgContainer">
            <span v-if="alerta.id_evento" class="evento">
                Evento
            </span>
            <span v-else :class="tipo === 2 ? 'perdido' : 'encontrado'">
                {{tipo === 2 ? 'Perdido' : 'Encontrado'}}
            </span>
            <ImagenesAlerta :imgs="alerta.id_evento ? alerta.imagen : alerta.imagenes" :principal="true" :esEvento="alerta.id_evento ? true : false" />
        </div>
        <div class="cardContent" v-if="tipo">    
            <h3 v-if="tipo === 2">{{alerta.nombre}}</h3>
            <ul class="encontradas-data" v-if="tipo === 1">
                <li>{{fechaBien}}</li>
                <li><Direccion :lat="alerta.latitud" :lng="alerta.longitud" /></li>
                
                <li v-if="alerta.sexo === null" class="desconocido">Sexo desconocido</li>
                <li v-else :class="alerta.sexo === 'Macho' ? 'macho' : 'hembra'">{{alerta.sexo}}</li>
                
                <li :class="alerta.especie === 'Perro' ? 'perro' : 'gato'">{{alerta.raza}}</li>
            </ul>
            <ul class="perdidas-data" v-else>
                <li>{{fechaBien}}</li>
                <li><Direccion :lat="alerta.latitud" :lng="alerta.longitud" /></li>
            </ul>
        </div>
        <div class="cardContent eventContent" v-else>    
            <h3>{{alerta.nombre}}</h3>
            <ul class="encontradas-data">
                <li>{{fechaBien}}</li>
                <li>{{alerta.direccion}}</li>
                
            </ul>
        </div>
    </div>
</template>
<script>
import ImagenesAlerta from './ImagenesAlerta.vue';
import Direccion from '../components/Direccion.vue'

export default {
    name: 'CardAlerta',
    components:{
        ImagenesAlerta,
        Direccion
    },
    computed:{
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
    },
    props: {
        alerta: { required: true },
        tipo: Number
    }
}
</script>
<style scoped>
.card{
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
}

.cardImgContainer{
    position: relative;
    height: 150px;
}

.cardImgContainer > span{
    position: absolute;
    left: 0;
    top: 5px;
    color: #fff;
    padding: 2px 5px;
    border-radius: 0 5px 5px 0;
}

.cardImgContainer > .perdido{
    background-color: #E5446D;
}

.cardImgContainer > .encontrado{
    background-color: #44BBA4;
    color: #fff;
}

.cardImgContainer > .evento{
    background-color: var(--secondary);
    color: #fff;
}

.cardImgContainer img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cardContent{
    text-align: left;
    padding: .5rem 1rem;
    padding-bottom: 1.5rem;
}

.cardContent h3{
    margin-bottom: 1rem;
}

.cardContent ul li{
    margin: .5rem 0;
    display: flex;
    align-items: center;
}

.cardContent ul li:last-of-type{
    height: 40px;
}

.perdidas-data >>> li::before{
    display: block;
    width: 16px;
    height: 16px;
    content: "";
    margin-right: 10px;
}

.perdidas-data >>> li:first-of-type::before{
    background: url("../assets/icons/calendar.svg") no-repeat center;
    background-size: contain;
}

.perdidas-data >>> li:last-of-type::before{
    background: url("../assets/icons/map-pin.svg") no-repeat center;
    background-size: contain;
}

.encontradas-data >>> li::before{
    display: block;
    width: 16px;
    height: 16px;
    content: "";
    margin-right: 10px;
}

.encontradas-data >>> li:first-of-type::before{
    background: url("../assets/icons/calendar.svg") no-repeat center;
    background-size: contain;
}

.encontradas-data >>> li:nth-of-type(2)::before{
    background: url("../assets/icons/map-pin.svg") no-repeat center;
    background-size: contain;
}

.desconocido::before{
    background: url("../assets/icons/question.svg") no-repeat center;
    background-size: contain;
}

.macho::before{
    background: url("../assets/icons/macho.svg") no-repeat center;
    background-size: contain;
}

.hembra::before{
    background: url("../assets/icons/hembra.svg") no-repeat center;
    background-size: contain;
}

.perro::before{
    background: url("../assets/icons/perro.svg") no-repeat center;
    background-size: contain;
}

.gato::before{
    background: url("../assets/icons/gato.svg") no-repeat center;
    background-size: contain;
}

.direccionBien{
    width: 100%;
}

.eventContent h3{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 46px;
}
</style>