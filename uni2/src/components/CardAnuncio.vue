<template>
    <div class="card">
        <a href="https://www.puppis.com.ar/adopcion" target="_blank">
            <div class="cardImgContainer"><img :src="require(`../assets/${anuncio.img}`)" :alt="'Imagen de' + anuncio.nombre"></div>
            <div class="cardContent">    
                <h3>{{anuncio.titulo}}</h3>
                <p>{{anuncio.texto}}</p>
            </div>
        </a>
    </div>
</template>
<script>
export default {
    name: 'CardAnuncio',
    props: {
        anuncio: { required: true }
    }
}
</script>
<style scoped>
.card{
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    margin: 2rem 0;
}
.card > a{
    display: block;
}
.cardImgContainer img{
    width: 100%;
    height: 175px;
    object-fit: cover;
}
.cardContent{
    text-align: left;
    padding: .5rem 1rem;
    padding-bottom: 1.5rem;
}
.cardContent h3{
    margin-bottom: .5rem;
}
.cardContent p{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>