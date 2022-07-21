<template>
    <div class="imgContainer">
        <img v-if="principal" :src="imgPrincipal" alt="Imagen de la mascota">
        <ul v-else-if="!esParaEditar" id="sliderImgs">
            <li v-for="(img, index) in imgs" :key="index">
                <img :src="imgRoute(img.imagen)" :alt="img.imagen">
            </li>
        </ul>
        <ul v-else id="listaImgs">
            <li v-for="(img, index) in imgs" :key="index">
                <img :src="imgRoute(img.imagen)" :alt="img.imagen">
            </li>
        </ul>
    </div>
</template>
<script>
import {IMG_PATH, EVENTOS_IMG_PATH} from '../constantes/index'

export default {
    name: 'ImagenesAlerta',
    props:{
        esEvento: {default: false},
        esParaEditar: {default: false},
        principal: {default: false},
        imgs: {required: true},
    },
    computed: {
        imgPrincipal: function(){
            return this.esEvento ? EVENTOS_IMG_PATH + this.imgs : IMG_PATH + this.imgs[0].imagen;
        }
    },
    methods: {
        imgRoute: function(img){
            return this.isEvento ? EVENTOS_IMG_PATH + img : IMG_PATH + img
        }
    },
}
</script>
<style scoped>
    .imgContainer{
        height: 100%;
    }
    .imgContainer >>> img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    #sliderImgs{
        display: flex;
        width: 100%;
        height: 100%;
        overflow: auto;
        scroll-snap-type: x mandatory;
    }
    #sliderImgs > li{
        width: 100%;
        flex-shrink: 0;
        scroll-snap-align: start;
    }

    #listaImgs{
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 100%;
        overflow-x: auto;
    }
</style>