<template>
    <Loader v-if="isLoading" />
    <div v-else-if="alerta" id="alerta">
        <div v-if="deleteConfirmation" class="deleteModal">
            <div class="deleteModalContent">
                <h2>¿Estás seguro?</h2>
                <div>
                    <button @click.prevent="deleteConfirmation = false" class="btn btn-secondary">Cancelar</button>
                    <button @click="borrarAlerta" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>

        <div class="header">
            <ImagenesAlerta :imgs="alerta.imagenes" :principal="true" />
            <div @click="$router.push(goBackRoute)" class="go-back">
                <span>Volver</span>
            </div>
            <div v-if="usuarioCreoAlerta" @click="opciones = !opciones" class="settings">...</div>
            <div v-if="usuarioCreoAlerta" :class="opciones ? 'opened' : 'closed'" class="menu-opciones">
                <ul>
                    <li>
                        <router-link :to="'/alertas/editar/' + alerta.id_alerta" @click.prevent="opciones = false">Editar</router-link>
                    </li>
                    <li>
                        <a href="#" @click.prevent="deleteConfirmation = true">Eliminar</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h2>{{alerta.nombre}}</h2>
                <span :class="alerta.id_tipoalerta == 1 ? 'encontrada' : 'perdida'">{{tipoAlerta}}</span>
            </div>
            <div class="data">
                <div v-if="alerta.id_sexo === null">
                    <img src="../assets/icons/question.svg" alt="Sexo desconocido">
                    <p>{{sexoName}}</p>
                </div>
                <div v-else>
                    <img :src="this.alerta.id_sexo === 1 ? require('../assets/icons/macho.svg') : require('../assets/icons/hembra.svg')" :alt="this.alerta.id_sexo === 1 ? 'Símbolo masculino' : 'Símbolo femenino'">
                    <p>{{sexoName}}</p>
                </div>

                <div>
                    <img :src="this.alerta.id_especie === 1 ? require('../assets/icons/perro.svg') : require('../assets/icons/gato.svg')" :alt="this.alerta.id_especie === 1 ? 'Silueta de un perro' : 'Silueta de un gato'">
                    <p>{{alerta.raza.raza}}</p>
                </div>
            </div>
            <ul>
                <li>{{fechaBien}}</li>
                <li>{{alerta.hora}}</li>
                <li><Direccion :lat="alerta.latitud" :lng="alerta.longitud" /></li>
            </ul>
            <div v-if="alerta.descripcion" class="descripcion">
                <h3>Características</h3>
                <p>{{alerta.descripcion}}</p>
            </div>
            <div class="wpp-container">
                <a class="btn btn-primary" target="_blank" :href="wppLink">Enviar Whatsapp</a>
            </div>
        </div>
    </div>
</template>
<script>
import alertasServicio from '../servicios/alertasServicio';
import ImagenesAlerta from '../components/ImagenesAlerta.vue';
import Direccion from '../components/Direccion.vue'
import Loader from '../components/Loader.vue'
import storageServicio from '../servicios/storageServicio';

export default {
    name: "DetalleAlerta",
    components:{
        ImagenesAlerta,
        Direccion,
        Loader
    },
    mounted() {
        this.isLoading = true;
        alertasServicio.get(this.$route.params.id).then(res => {
        this.alerta = res;

        this.isLoading = false;
        });
    },
    methods: {
        borrarAlerta: function(){
            alertasServicio.delete(this.alerta.id_alerta)
            .then(res => {
                if(res){
                this.opciones = false,
                this.deleteConfirmation = false,
                this.$router.push('/alertas');
                }
            })
        }
    },
    computed:{
        wppLink: function() {
            //AGREGAR EL CODIGO DE PAIS (54)
            return `https://api.whatsapp.com/send?phone=${this.alerta.telefono}&text=Hola!%20Me%20comunico%20por%20la%20alerta%20que%20subiste%20a%20la%20app%20Unidos.%20`;
        },
        usuarioCreoAlerta: function(){
            return storageServicio.getUsuario().id_usuario == this.alerta.id_usuario
        },
        goBackRoute: function(){
            return '/' + this.$route.query.from;
        },
        fechaBien: function(){
            if(this.alerta.fecha == null){
                return 'No se sabe';
            } 
            let fecha = this.alerta.fecha.split('-');
            return fecha[2] + ' / ' + fecha[1] + ' / ' + fecha[0]; 
        },
        horaBien: function(){
            if(this.alerta.created_at == null){
                return 'No se sabe';
            } 
            let hora = this.alerta.created_at.split('T')[1].split(':');
            return hora[0] + ':' + hora[1]; 
        },
        sexoName() {
            if(this.alerta.id_sexo === 1) {
                return 'Macho';
            } else if(this.alerta.id_sexo === 2){
                return 'Hembra';
            }
            return 'Sexo desconocido';
        },
        especieName() {
            if(this.alerta.id_especie === 1) {
                return 'Perro';
            } else if(this.alerta.id_especie === 2){
                return 'Gato';
            }
            return false;
        },
        tipoAlerta() {
            if(this.alerta.id_tipoalerta === 1) {
                return 'Encontrada';
            } else if(this.alerta.id_tipoalerta === 2){
                return 'Perdida';
            }
            return false;
        }
    },
    data() {
        return {
            isLoading: false,
            alerta: null,
            opciones: false,
            deleteConfirmation: false,

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

    #alerta > .header{
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

    #alerta > .header .settings{
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

    #alerta > .header .menu-opciones{
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

    #alerta > .header .menu-opciones ul li a{
        display: block;
        padding: .5rem;
    }

    #alerta > .header .settings::after{
        content: "...";
        font-size: 22px;
        width: 18px;
        height: 38px;
    }

    #alerta > .content{
        padding: 1rem;

    }

    #alerta > .content .title{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
    }

    #alerta > .content .title span{
        color: #fff;
        height: fit-content;
        padding: .5rem;
        border-radius: 25px;
    }

    #alerta > .content .title .perdida{
        background: var(--perdida);
    }

    #alerta > .content .title .encontrada{
        background: var(--encontrada);
    }

    #alerta > .content .data{
        display: flex;
        justify-content: space-around;
        margin: 1rem 0;
    }
    
    #alerta > .content > ul{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 1rem 0;
    }

    #alerta > .content > ul li{
        min-width: 50%;
        margin: .5rem 0;
        display: flex;
        align-items: center;
    }

    #alerta > .content > ul li::before{
        width: 16px;
        height: 16px;
        content: "";
        margin-right: 10px;
    }

    #alerta > .content > ul li:first-of-type::before{
        background: url("../assets/icons/calendar.svg") center no-repeat;
        background-size: contain;
    }

    #alerta > .content > ul li:nth-of-type(2)::before{
        background: url("../assets/icons/clock.svg") center no-repeat;
        background-size: contain;
    }

    #alerta > .content > ul li:last-of-type::before{
        background: url("../assets/icons/map-pin.svg") center no-repeat;
        background-size: contain;
    }

    .data > div{
        text-align: center;
    }

    .data img{
        height: 42px;
    }

    .data p{
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 100px;
        text-align: center;
    }

    .descripcion > h3{
        margin-bottom: .5rem;
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