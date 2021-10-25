<template>
    <div>
        <h1>Alertas</h1>
        <div v-if="isLoading">Cargando...</div>
        <div v-else-if="alertas.length == 0" id="sin-alertas">
            <img src="../assets/no-alertas.png" alt="Gato durmiendo sobre una campana de notificaciones">
            <p>Aún no recibiste ninguna alerta.</p>
        </div>
        <ul id="alertas" v-else>
            <li v-for="(alerta, index) in alertas" :key="index">
                <router-link :to="'alertas/' + alerta.id_alerta">
                    <div>
                        <img src="https://dummyimage.com/85x85/ccc/eee" alt="">
                    </div>
                    <div>
                        <h2>Tu aviso de <strong>{{alerta.nombre}}</strong> fue publicado con éxito.</h2>
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script>
import alertasServicio from '../servicios/alertasServicio'

export default {
    name: 'Alertas',
    mounted() {
        this.isLoading = true;
        alertasServicio.deUsuario(1).then(res => {
            this.alertas = res;
            this.isLoading = false;
        })
    },
    data() {
        return {
            isLoading: false,
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
    }
    #alertas > li > a > div img{
        height: 100%;
        object-fit: cover;
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