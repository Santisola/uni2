<template>
    <div class="sliderAlertas">
        <div class="header">
            <h2>{{titulo}}</h2>
            <a href="#">Ver todo</a>
        </div>
        <div class="sliderContent">
            <ul>
                <li v-for="(alerta, index) in alertas" :key="index">
                    <router-link to="#">
                        <CardAlerta :alerta="alerta" :tipo="tipo"/>
                    </router-link>
                </li>
            </ul>
        </div>
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

.sliderAlertas .sliderContent{
    width: 100%;
    overflow: auto;
}

.sliderAlertas .sliderContent > ul{
    display: flex;
    overflow: auto;
    width: 180%;
}
.sliderAlertas .sliderContent > ul > li{
    width: 45%;
    margin: .25rem .5rem;
    padding: .5rem 0;
}
</style>