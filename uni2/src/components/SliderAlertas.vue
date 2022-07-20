<template>
    <div class="sliderAlertas">
        <div class="header">
            <h2>{{titulo}}</h2>
            <!-- <a href="#">Ver todo</a> -->
        </div>
        <ul>
            <li v-for="(alerta, index) in reversedAlertas" :key="index">
                <router-link :to="'/alertas/' + alerta.id_alerta.toString() + '?from=home'">
                    <CardAlerta :alerta="alerta" :tipo="tipo"/>
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script>
import CardAlerta from './CardAlerta.vue';

export default {
    name: 'SliderAlertas',
    components:{
        CardAlerta,
    },
    props:{
        titulo:{ required: true },
        alertas:{ required: true },
        tipo: Number
    },
    computed: {
        reversedAlertas: function(){
            let newAlertas = [];
            const alertasCopy = [...this.alertas].reverse();
            for (let i = 0; i < 5; i++) {
                if(alertasCopy[i]){
                    newAlertas.push(alertasCopy[i]);
                }
            }

            return newAlertas;
        }
    }
}
</script>
<style scoped>
.sliderAlertas .header{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sliderAlertas .header h2{
    font-size: 1.05rem;
}

.sliderAlertas .header a{
    font-weight: bold;
    color: var(--primary);
    font-size: .95rem;
}

.sliderAlertas{
    width: 100%;
    overflow: hidden;
}

.sliderAlertas > ul{
    display: flex;
    overflow: auto;
    width: 100%;
    scroll-snap-type: x mandatory;
}
.sliderAlertas > ul > li{
    width: 200px;
    margin: .25rem .5rem;
    padding: .5rem 0;
    flex-shrink: 0;
    scroll-snap-align: start;
}

.sliderAlertas > ul > li:first-of-type{
    margin-left: 0;
}

.sliderAlertas > ul > li:last-of-type{
    margin-right: 0;
}
</style>