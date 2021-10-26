<template>
    <div class="card">
        <div class="cardImgContainer">
            <span :class="tipo === 2 ? 'perdido' : 'encontrado'">
                {{tipo === 2 ? 'Perdido' : 'Encontrado'}}
            </span>
            <ImagenesAlerta :imgs="alerta.imagenes" :principal="true" />
        </div>
        <div class="cardContent">    
            <h3 v-if="tipo === 2">{{alerta.nombre}}</h3>
            <ul>
                <li>{{fechaBien}}</li>
                <li>{{alerta.especie}}</li>
                <li>Direcion 1234{{alerta.direccion}}</li>
                <li>{{alerta.sexo}}</li>
                <li>{{alerta.raza}}</li>
            </ul>
        </div>
    </div>
</template>
<script>
import ImagenesAlerta from './ImagenesAlerta.vue';

export default {
    name: 'CardAlerta',
    components:{
        ImagenesAlerta
    },
    computed:{
        fechaBien: function(){
            if(this.alerta.fecha == null){
                return 'No se sabe';
            } 
            let fecha = this.alerta.fecha.split('T')[0].split('-');
            return fecha[2] + ' / ' + fecha[1] + ' / ' + fecha[0]; 
        }
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
    color: #eee;
}

.cardImgContainer img{
    width: 100%;
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
}
.cardContent ul li:last-of-type{
    height: 40px;
}
</style>