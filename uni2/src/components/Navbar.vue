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
a::before{
    content: "";
    display: block;
    width: 24px;
    height: 24px;
    margin: auto;
    background: #ddd;
}
</style>