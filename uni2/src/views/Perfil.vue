<template>
    <div>
        <h1>Perfil</h1>
        <button @click="logout" class="btn btn-primary">Cerrar sesión</button>
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';

export default {
    name: 'Perfil',
    methods: {
        logout: function(){
            authServicio.logout()
        }
    },
}
</script>
<style>
    
</style>