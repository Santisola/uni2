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
                        <input v-bind:disabled="isLoading" v-model="editarUsuario.nombre" type="text" name="nombre" id="nombre-editar">
                    </div>
                    <div class="form-group">
                        <label for="email-editar">Email</label>
                        <input v-bind:disabled="isLoading" v-model="editarUsuario.email" type="text" name="email" id="email-editar">
                    </div>
                    <div class="form-group">
                        <label for="telefono-editar">Teléfono</label>
                        <input v-bind:disabled="isLoading" v-model="editarUsuario.telefono" type="text" name="telefono" id="telefono-editar">
                    </div>
                    <button v-bind:disabled="isLoading || !isValid" :class="isLoading || !isValid ? 'btn btn-disabled' : 'btn btn-primary'"><MiniLoader v-if="isLoading" /><span v-else>Editar</span></button>
                </form>
                <div v-if="erroresBack !== null" class="msj msj-error">
                    <ul>
                        <li v-for="(error, index) in erroresBackArray" :key="index">{{error}}</li>
                    </ul>
                </div>
            </li>
            <li @click="$router.push('/alertas')">Mis alertas</li>
            <li @click="logout">Cerrar sesión</li>
        </ul>
        
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';
import MiniLoader from '../components/MiniLoader.vue';

export default {
    name: 'Perfil',
    components:{
        MiniLoader
    },
    mounted() {
        this.isLoading = true;
        this.usuario = authServicio.getUsuario();
        this.editarUsuario = authServicio.getUsuario();
        this.isLoading = false;
    },
    computed:{
        isValid: function(){
            if(this.editarDatos){
                if(this.editarUsuario.nombre.trim() === ''){
                    return false
                }
                if(this.editarUsuario.email.trim() === ''){
                    return false
                }
                if(this.editarUsuario.telefono.trim() === ''){
                    return false
                }
    
                if(
                this.editarUsuario.telefono.trim()[0] == '0' ||
                this.editarUsuario.telefono.includes('+') ||
                this.editarUsuario.telefono.includes('(') ||
                this.editarUsuario.telefono.includes(')') ||
                this.editarUsuario.telefono.includes('-') ||
                this.editarUsuario.telefono.includes(' ') ||
                this.editarUsuario.telefono.includes('/')
                ){
                    return false
                }
    
                return true
            }
            return false
        },   
        erroresBackArray: function(){
            if(this.erroresBack === null){
                return false
            }

            let errores = [];
            for (const error in this.erroresBack) {
                if (Object.hasOwnProperty.call(this.erroresBack, error)) {
                    errores.push(this.erroresBack[error][0])
                }
            }
            return errores
        }     
    },
    methods: {
        logout: function(){
            if(authServicio.logout()){
                this.$router.push('/login')
            }
        },
        editar: function(){
            this.isLoading = true;
            this.erroresBack = null;
            authServicio.editar(this.editarUsuario)
            .then(rta => {
                if(rta.success){
                    this.usuario = rta.data;

                    this.editarUsuario = {
                        nombre: rta.data.nombre,
                        email: rta.data.email,
                        telefono: rta.data.telefono,
                        id_usuario: rta.data.id_usuario,
                    }

                    this.isLoading = false;
                    this.editarDatos = false
                }else{
                    this.erroresBack = rta.errors;
                    this.isLoading = false;
                }
            })
        }
    },
    data() {
        return {
            editarDatos: false,
            isLoading: false,
            erroresBack: null,
            usuario: {},
            editarUsuario: {
                nombre: null,
                email: null,
                telefono: null,
                id_usuario: null,
            }
        }
    },
}
</script>
<style scoped>
    .user-menu{
        margin-top: 2rem;
    }
    .user-menu > li{
        padding: 1rem 0;
        border-top: solid 1px #ccc;
    }

    .user-menu > li:last-of-type{
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

    .loader{
        width: 18px!important;
        height: 18px!important;
    }
</style>