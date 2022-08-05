<template>
    <div>
        <h1>Perfil</h1>
        <div class="columnas-2">
          <div class="datosUsuario">
            <div class="userHeader">
                <div>
                    <img :src="imagenUsuario" alt="Foto de perfil del usuario">
                </div>
                <ul>
                    <li><h2>{{usuario.nombre}}</h2></li>
                    <li>{{usuario.email}}</li>
                    <!-- <li>{{usuario.telefono}}</li> -->
                </ul>
            </div>
          </div>
        </div>
        <ul class="user-menu">
            <li @click="editarDatos = !editarDatos">Editar mis datos</li>
            <li :style="editarDatos ? 'max-height: 550px;' : 'max-height: 0;'" class="editar-form">
                <form @submit.prevent="editar" action="#">
                    <div class="form-group">
                        <label for="imagen">Foto de perfil</label>
                        <div id="imgPreviewContainer" v-if="editarImagen">
                            <img :src="editarImagen" alt="Nueva foto de perfil">
                        </div>
                        <input type="file" ref="imagen" id="imagen" name="imagen" accept="image/*" @change="cargarImg">
                    </div>
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
import {EVENTOS_IMG_PATH} from '../constantes/index';

export default {
    name: 'Perfil',
    components:{
        MiniLoader
    },
    mounted() {
        this.isLoading = true;

        this.usuario = authServicio.getUsuario();
        this.editarUsuario = {
            nombre: this.usuario.nombre,
            email: this.usuario.email,
            telefono: this.usuario.telefono,
            id_usuario: this.usuario.id_usuario,
        }
        this.isLoading = false;
    },
    computed:{
        imagenUsuario: function(){
            return this.usuario.imagen ? EVENTOS_IMG_PATH + '' + this.usuario.imagen : EVENTOS_IMG_PATH + 'imgs/user-default.png';
        },
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
                this.editarUsuario.telefono.trim()[0] === '0' ||
                this.editarUsuario.telefono.includes('+') ||
                this.editarUsuario.telefono.includes('(') ||
                this.editarUsuario.telefono.includes(')') ||
                this.editarUsuario.telefono.includes('-') ||
                this.editarUsuario.telefono.includes(' ') ||
                this.editarUsuario.telefono.includes('/')
                ){
                    return false;
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
        },
    },
    methods: {
        cargarImg: function (){
            const imagen = this.$refs.imagen.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                this.editarImagen = reader.result;
            })
            reader.readAsDataURL(imagen);
        },
        logout: function () {
            if (authServicio.logout()) {
            this.$router.push('/login')
            }
        },
        editar: function () {
            this.isLoading = true;
            this.erroresBack = null;

            let data = {};
            if(this.editarImagen){
                data = {
                    ...this.editarUsuario,
                    imagen: this.editarImagen,
                }
            }else{
                data = {...this.editarUsuario}
            }

            authServicio.editar(data)
                .then(rta => {
                if (rta.success) {
                    this.usuario = rta.data;

                    this.editarUsuario = {
                        nombre: rta.data.nombre,
                        email: rta.data.email,
                        telefono: rta.data.telefono,
                        id_usuario: rta.data.id_usuario,
                    }
                    this.editarImagen = null;

                    this.isLoading = false;
                    this.editarDatos = false
                } else {
                    this.erroresBack = rta.errors;
                    this.isLoading = false;
                }
                })
        },
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
            },
            editarImagen: null,
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

    .imgPerfil {
      /*max-width: 50px;*/
      width: 100%;
      border-radius: 50%;
      display: block;
    }

    .columnas-2 {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 1rem;
      margin-top: 1rem;
    }

    .datosUsuario li {
      margin-bottom: 5px;
    }

    .userHeader{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .userHeader > div{
        width: 65px;
        height: 65px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 1rem;
        background-color: #fff;
        box-shadow: 0 4px 12px rgb(152 152 152 / 25%);
    }

    .userHeader > div img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    #imagen{
        border: 0;
        padding: 0;
    }

    #imgPreviewContainer{
        width: 75px;
        height: 75px;
        background-color: #fff;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: .5rem;
        box-shadow: 0 4px 12px rgb(152 152 152 / 25%);
    }

    #imgPreviewContainer img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>