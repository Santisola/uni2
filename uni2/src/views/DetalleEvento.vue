<template>
    <Loader v-if="isLoading" />
    <div v-else-if="evento" id="evento">

        <div class="header">
            <ImagenesAlerta :imgs="evento.imagen" :principal="true" :esEvento="true" />
            <div @click="$router.push(goBackRoute)" class="go-back">
                <span>Volver</span>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h2>{{evento.nombre}}</h2>
                <span class="evento">Evento</span>
            </div>
            <div v-if="evento.descripcion" class="descripcion">
                <p>{{evento.descripcion}}</p>
            </div>

            <div class="fechas">
                <h3>¿Desde que día?</h3>
                <ul>
                    <li>{{fechaBienDesde.fecha}}</li>
                    <li>{{fechaBienDesde.hora}}</li>
                </ul>
            </div>
            <div class="fechas">
                <h3>¿Hasta cuándo?</h3>
                <ul>
                    <li>{{fechaBienHasta.fecha}}</li>
                    <li>{{fechaBienHasta.hora}}</li>
                </ul>
            </div>
            <div class="lugar">
                <h3>¿En dónde?</h3>
                <ul>
                    <li><Direccion :lat="evento.latitud" :lng="evento.longitud" /></li>
                </ul>
            </div>
            <div class="wpp-container">
                <a class="btn btn-primary" target="_blank" :href="wppLink">Enviar Whatsapp</a>
            </div>
        </div>
    </div>
</template>
<script>
import eventosServicio from '../servicios/eventosServicio';
import ImagenesAlerta from '../components/ImagenesAlerta.vue';
import Direccion from '../components/Direccion.vue'
import Loader from '../components/Loader.vue'

export default {
    name: "DetalleEvento",
    components:{
        ImagenesAlerta,
        Direccion,
        Loader
    },
    mounted() {
        this.isLoading = true;
        eventosServicio.get(this.$route.params.id).then(res => {
            this.evento = res;

            this.isLoading = false;
        });
    },
    computed:{
        wppLink: function() {
            //AGREGAR EL CODIGO DE PAIS (54)
            return `https://api.whatsapp.com/send?phone=${this.evento.telefono}&text=Hola!%20Me%20interesó%20el%20evento%20'${this.evento.nombre}'%20que%20subiste%20a%20la%20app%20Unidos. Quisiera saber más por favor.%20`;
        },
        goBackRoute: function(){
            return '/' + this.$route.query.from;
        },
        fechaBienDesde: function(){
            if(this.evento.desde == null){
                return 'No se sabe';
            }

            let fecha = this.evento.desde.split(' ')[0].split('-');
            let hora = this.evento.desde.split(' ')[1].split(':')
            return {
                fecha: `${fecha[2]}/${fecha[1]}/${fecha[0]}`,
                hora: `${hora[0]}:${hora[1]}hs`,
            };
        },
        fechaBienHasta: function(){
            if(this.evento.hasta == null){
                return 'No se sabe';
            }

            let fecha = this.evento.hasta.split(' ')[0].split('-');
            let hora = this.evento.hasta.split(' ')[1].split(':')
            return {
                fecha: `${fecha[2]}/${fecha[1]}/${fecha[0]}`,
                hora: `${hora[0]}:${hora[1]}hs`,
            };
        }
    },
    data() {
        return {
            isLoading: false,
            evento: null,

            direccion: '',
        }
    },
}
</script>
<style scoped>
    .go-back{
        position: absolute;
        top: 1rem;
        left: 1rem;
        font-size: 0;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: block;
        background-image: url('../assets/icons/arrow.svg');
        background-repeat: no-repeat;
        background-position: center;
        background-color: #fff;
    }

    .deleteModal{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .deleteModalContent{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        border-radius: 4px;
        padding: 1rem;
        width: 80%;
    }

    .deleteModalContent h2{
        margin-bottom: 1rem;
    }

    .deleteModalContent > div{
        display: flex;
        justify-content: flex-end;
    }

    #evento > .header{
        margin: -1rem;
        margin-bottom: 0;
        width: calc(100% + 2rem);
        height: 50vh;
        position: relative;
        overflow: hidden;
    }

    .imgContainer >>> img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    #evento > .header .settings{
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #fff;
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transform: rotate(90deg);
        font-size: 0;
        font-weight: bold;
        cursor: pointer;
    }

    #evento > .header .menu-opciones{
        position: absolute;
        top: 4.5rem;
        background: #fff;
        padding: .5rem;
        border-radius: 4px 0 4px 4px;
        transition: all 250ms ease;
    }

    .menu-opciones.closed{
        right: -10rem;
    }

    .menu-opciones.opened{
        right: 1rem;
    }

    #evento > .header .menu-opciones ul li a{
        display: block;
        padding: .5rem;
    }

    #evento > .header .settings::after{
        content: "...";
        font-size: 22px;
        width: 18px;
        height: 38px;
    }

    #evento > .content{
        padding: 1rem;

    }

    #evento > .content .title{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
    }

    #evento > .content .title h2{
        word-break: break-word;
    }

    #evento > .content .title span{
        color: #fff;
        height: fit-content;
        padding: .5rem;
        border-radius: 25px;
    }

    #evento > .content .title .evento{
        background: var(--secondary);
    }

    #evento > .content .data{
        display: flex;
        justify-content: space-around;
        margin: 1rem 0;
    }

    #evento > .content > .fechas,
    #evento > .content > .lugar{
        margin-bottom: 1.5rem;
    }
    

    #evento > .content > div ul li{
        min-width: 50%;
        margin: .5rem 0;
        display: flex;
        align-items: center;
    }

    #evento > .content > div ul li::before{
        width: 16px;
        height: 16px;
        content: "";
        margin-right: 10px;
    }

    #evento > .content > .fechas ul li:first-of-type::before{
        background: url("../assets/icons/calendar.svg") center no-repeat;
        background-size: contain;
    }

    #evento > .content > .fechas ul li:last-of-type::before{
        background: url("../assets/icons/clock.svg") center no-repeat;
        background-size: contain;
    }

    #evento > .content > .lugar ul li::before{
        background: url("../assets/icons/map-pin.svg") center no-repeat;
        background-size: contain;
    }

    .descripcion{
        margin-bottom: 2rem;
    }

    .descripcion > p{
        word-break: break-word;
    }

    .wpp-container{
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
    }
    
    .btn-primary{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .content .btn-primary::before{
        content: "";
        display: block;
        width: 24px;
        height: 24px;
        background: url('../assets/icons/wpp.svg')no-repeat center;
        background-size: contain;
        margin-right: 5px;
    }

    .direccionBien{
        width: 100%;
    }
</style>