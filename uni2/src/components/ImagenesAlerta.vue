<template>
    <div>
        <img v-if="principal" :src="imagenes[0]" alt="Imagen de la mascota">
        <ul v-else>
            <li v-for="(img, index) in imagenes" :key="index">
                <img :src="img" :alt="img">
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'ImagenesAlerta',
    props:{
        principal: {default: false},
        imgs: {required: true}
    },
    
    computed: {
        imagenes: function (){
            return this.imgs.split('|')
        }
    }
}
</script>
<style>
    
</style>