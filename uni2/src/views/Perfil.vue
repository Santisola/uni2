<template>
    <div>
        <h1>Perfil</h1>
        <h2>{{usuario.nombre}}</h2>
        <ul>
            <li>{{usuario.email}}</li>
            <li>{{usuario.telefono}}</li>
        </ul>

        <ul class="user-menu">
            <li @click="editarDatos = !editarDatos">Editar mis datos</li>
            <li :style="editarDatos ? 'max-height: 500px;' : 'max-height: 0;'" class="editar-form">
                <form @submit.prevent="editar" action="#">
                    <div class="form-group">
                        <label for="nombre-editar">Nombre</label>
                        <input v-model="editarUsuario.nombre" type="text" name="nombre" id="nombre-editar">
                    </div>
                    <div class="form-group">
                        <label for="email-editar">Email</label>
                        <input v-model="editarUsuario.email" type="text" name="email" id="email-editar">
                    </div>
                    <div class="form-group">
                        <label for="telefono-editar">Teléfono</label>
                        <input v-model="editarUsuario.telefono" type="text" name="telefono" id="telefono-editar">
                    </div>
                    <button class="btn btn-primary">Editar</button>
                </form>
            </li>
            <li @click="$router.push('/alertas')">Notificaciones</li>
            <li @click="logout">Cerrar sesión</li>
        </ul>
        
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';

export default {
    name: 'Perfil',
    mounted() {
        this.isLoading = true;
        this.usuario = authServicio.getUsuario();
        this.editarUsuario = authServicio.getUsuario();
        this.isLoading = false;
    },
    methods: {
        logout: function(){
            if(authServicio.logout()){
                this.$router.push('/login')
            }
        },
        editar: function(){
            this.editarDatos = false
        }
    },
    data() {
        return {
            editarDatos: false,
            isLoading: false,
            usuario: {},
            editarUsuario: {}
        }
    },
}
</script>
<style scoped>
    .user-menu{
        margin-top: 2rem;
    }
    .user-menu li{
        padding: 1rem 0;
        border-top: solid 1px #ccc;
    }

    .user-menu li:last-of-type{
        border-bottom: solid 1px #ccc;
    }

    .editar-form{
        padding: 0!important;
        border: 0!important;
        overflow: hidden;
        transition: all 250ms ease;
    }

    .editar-form form > div:first-of-type label{
        border-top: solid 1px #ccc;
        margin-top: 0;
    }

    .editar-form .btn{
        width: 100%;
        margin: 1rem 0;
    }
</style>