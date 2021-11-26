<template>
    <div>
        <h1>Alertas</h1>
        <MiniLoader v-if="isLoading" />
        <div v-else-if="alertas.length == 0" id="sin-alertas">
            <img src="../assets/no-alertas.png" alt="Gato durmiendo sobre una campana de notificaciones">
            <p>Aún no recibiste ninguna alerta.</p>
        </div>
        <ul id="alertas" v-else>
            <li v-for="(alerta, index) in reversedAlertas" :key="index">
                <router-link :to="'alertas/' + alerta.id_alerta + '?from=alertas'">
                    <div>
                        <ImagenesAlerta :imgs="alerta.imagenes" :principal="true" />
                    </div>
                    <div>
                        <h2 v-if="alerta.nombre">Tu alerta de <strong>{{alerta.nombre}}</strong> fue publicada con éxito.</h2>
                        <h2 v-else>Tu alerta fue publicada con éxito.</h2>
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script>
import alertasServicio from '../servicios/alertasServicio'
import ImagenesAlerta from '../components/ImagenesAlerta.vue'
import authServicio from '../servicios/authServicio';
import MiniLoader from '../components/MiniLoader.vue';

export default {
    name: 'Alertas',
    components:{
        ImagenesAlerta,
        MiniLoader
    },
    mounted() {
        this.isLoading = true;
        this.usuario = authServicio.getUsuario();
        alertasServicio.deUsuario(this.usuario.id_usuario).then(res => {
            this.alertas = res;
            setTimeout(() => {
				this.isLoading = false
			}, 750)
        })
    },
    computed: {
        reversedAlertas: function(){
            return [...this.alertas].reverse();
        }
    },
    data() {
        return {
            isLoading: false,
            usuario: {},
            alertas: []
        }
    },
}
</script>
<style scoped>
    h1{
        font-style: normal;
        font-weight: 800;
        font-size: 24px;
        line-height: 32px;
        color: #222222;
    }
    #sin-alertas{
        text-align: center;
        margin-top: 2rem;
    }
    #sin-alertas p {
        font-size: 16px;
        line-height: 24px;
        font-weight: 400;
        color: #656565;
    }
    #alertas > li > a{
        display: flex;
        align-items: center;
        background: #fff;
        margin: 1rem 0;
        border-radius: 4px;
        overflow: hidden;
    }
    #alertas > li > a > div:first-of-type{
        line-height: 0;
        width: 85px;
        min-width: 85px;
        height: 85px;
    }
    .imgContainer >>> img{
        height: 100%;
        object-fit: contain;
        line-height: 0;
    }
    #alertas > li > a > div:last-of-type{
        padding: 1rem;    
        display: flex;
        justify-content: space-between;    
    }
    #alertas > li > a h2{
        font-weight: 400;
        font-size: 18px;
        color: #222;
    }
</style>