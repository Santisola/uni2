<template>
    <div class="imgContainer">
        <img v-if="principal" :src="imgPrincipal" alt="Imagen de la mascota">
        <ul v-else>
            <li v-for="(img, index) in imagenes" :key="index">
                <img :src="img" :alt="img">
            </li>
        </ul>
    </div>
</template>
<script>
import {IMG_PATH} from '../constantes/index'

export default {
    name: 'ImagenesAlerta',
    props:{
        principal: {default: false},
        imgs: {required: true}
    },
    
    computed: {
        imagenes: function (){
            return this.imgs.split('|')
        },

        imgPrincipal: function(){
            return IMG_PATH + this.imagenes[0];
            /* return 'img/perrito-default.jpg' */
        }
    }
}
</script>
<style scoped>
    .imgContainer{
        height: 100%;
    }
    .imgContainer >>> img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>