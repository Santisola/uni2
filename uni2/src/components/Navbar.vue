<template>
    <nav>
        <div id="navbar">
            <ul>
                <li><router-link to="/">Inicio</router-link></li>
                <li><router-link to="/buscar">Buscar</router-link></li>
                <li><router-link to="/publicar">Publicar</router-link></li>
                <li><router-link to="/alertas">Alertas</router-link></li>
                <li><router-link to="/perfil">Perfil</router-link></li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    name: 'Navbar',
}
</script>
<style scoped>
nav{
    padding: .25rem 1.5rem;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #fff;
    box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.25);
}

ul{
    display: flex;
    justify-content: space-between;
    align-items: center;
    list-style: none;
}

a{
    color: inherit;
    text-decoration: none;
    display: block;
    padding: 1rem 0;
}

.router-link-exact-active{
    color: var(--primary);
}

a::before{
    content: "";
    display: block;
    width: 20px;
    height: 20px;
    margin: auto;
    margin-bottom: .25rem;
}

#navbar > ul > li:first-of-type > a::before{
    background: url("../assets/icons/home.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(2) > a::before{
    background: url("../assets/icons/buscar.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(3) > a::before{
    background: url("../assets/icons/publicar.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(4) > a::before{
    background: url("../assets/icons/alertas.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:last-of-type > a::before{
    background: url("../assets/icons/perfil.svg") center no-repeat;
    background-size: contain;
}

#navbar > ul > li:first-of-type > .router-link-exact-active::before{
    background: url("../assets/icons/home-active.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(2) > .router-link-exact-active::before{
    background: url("../assets/icons/buscar-active.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(3) > .router-link-exact-active::before{
    background: url("../assets/icons/publicar-active.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:nth-of-type(4) > .router-link-exact-active::before{
    background: url("../assets/icons/alertas-active.svg") center no-repeat;
    background-size: contain;
}
#navbar > ul > li:last-of-type > .router-link-exact-active::before{
    background: url("../assets/icons/perfil-active.svg") center no-repeat;
    background-size: contain;
}

</style>