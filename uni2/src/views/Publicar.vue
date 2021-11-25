<template>
    <div>
        <div class="publicar-main-header">
            <h1>¿De qué se trata el aviso que querés publicar?</h1>
            <p>Seleccioná si es sobre una mascota perdida o encontrada:</p>
        </div>
        <ul class="nueva-alerta-options">
            <li>
                <router-link to="/publicar/perdida">
                    <h2>Mascota perdida</h2>
                </router-link>
            </li>
            <li>
                <router-link to="/publicar/encontrada">
                    <h2>Mascota encontrada</h2>
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'Publicar'
}
</script>
<style scoped>
h1{
    font-style: normal;
    font-weight: 600;
    font-size: 24px;
    line-height: 32px;
}

.publicar-main-header > p{
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #656565;
    margin-top: 1rem;
}

.nueva-alerta-options li a{
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 150px;
    background: #fff;
    border-radius: 4px;
    margin-top: 2.5rem;
    padding: 1rem;
    box-shadow: 0px 24px 24px -24px rgba(37, 37, 37, 0.15);
}

.nueva-alerta-options li:first-of-type a{
    border-left: solid 5px var(--perdida);
}

.nueva-alerta-options li:last-of-type a{
    border-right: solid 5px var(--encontrada);
}

.nueva-alerta-options li a h2{
    width: 45%;
    vertical-align: center;
}

.nueva-alerta-options li:first-of-type a::after{
    content: "";
    display: block;
    width: 40%;
    height: 100%;
    background: url("../assets/perdida-ilus.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.nueva-alerta-options li:last-of-type a::before{
    content: "";
    display: block;
    width: 40%;
    height: 100%;
    background: url("../assets/encontrada-ilus.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}
</style>