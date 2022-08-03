<template>
    <div>
        <Loader v-if="isLoading" />
        <div class="registro-header">
            <router-link to="/login">Volver</router-link>
            <h1>Crear cuenta</h1>

            <div v-if="erroresBack !== null" class="msj msj-error">
                <ul>
                    <li v-for="(error, index) in erroresBackArray" :key="index">{{error}}</li>
                </ul>
            </div>
            
            <form @submit.prevent="registrar" action="#">
                <div class="form-group">
                    <label for="registro-nombre">Nombre completo</label>
                    <input :disabled="isLoading" :aria-describedby="errores.nombre.error ? 'error-nombre' : null" @blur="validar('nombre')" v-model="usuario.nombre" type="text" id="registro-nombre" name="nombre" placeholder="Nombre completo">
                    <p id="error-nombre" class="msj msj-error" v-if="errores.nombre.error">{{errores.nombre.mensaje}}</p>
                </div>
                
                <div class="form-group">
                    <label for="registro-email">Email</label>
                    <input :disabled="isLoading" :aria-describedby="errores.email.error ? 'error-email' : null" @blur="validar('email')" v-model="usuario.email" type="text" id="registro-email" name="email" placeholder="mail@ejemplo.com.ar">
                    <p id="error-email" class="msj msj-error" v-if="errores.email.error">{{errores.email.mensaje}}</p>
                </div>
                
                <div class="form-group">
                    <label for="registro-password">Contraseña</label>
                    <div><input :disabled="isLoading" :aria-describedby="errores.password.error ? 'error-password' : null" @blur="validar('password')" v-model="usuario.password" :type="verContra ? 'text' : 'password'" id="registro-password" name="email"><span @click="verContra = !verContra">{{verContra ? 'Ocultar' : 'Mostrar'}}</span></div>
                    <p id="error-password" class="msj msj-error" v-if="errores.password.error">{{errores.password.mensaje}}</p>
                </div>
                <p class="password-info">Debe tener como mínimo 6 caracteres</p>

                <div class="form-group">
                    <label for="registro-celular">Celular</label>
                    <div>
                        <input :disabled="isLoading" :aria-describedby="errores.codigoArea.error ? 'error-codigo' : null" @blur="validar('codigoArea')" v-model="usuario.codigoArea" type="text" id="registro-area" name="cofigo-area" placeholder="54">
                        <input :disabled="isLoading" :aria-describedby="errores.telefono.error ? 'error-telefono' : null" @blur="validar('telefono')" v-model="usuario.telefono" type="text" id="registro-celular" name="telefono" placeholder="1122223333">
                    </div>
                    <p id="error-telefono" class="msj msj-error" v-if="errores.telefono.error">{{errores.telefono.mensaje}}</p>
                    <p id="error-codigo" class="msj msj-error" v-if="errores.codigoArea.error">{{errores.codigoArea.mensaje}}</p>
                </div>
                <p class="password-info">No debe contener espacios, ni caracteres especiales. Unicamente el número de corrido</p>

                <button :disabled="isLoading || !isValid" :class="isLoading || !isValid ? 'btn btn-disabled' : 'btn btn-primary'">Registrarme</button>
            </form>
        </div>
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';
import Loader from '../components/Loader.vue'

export default {
    name: "Registro",
    components:{
        Loader
    },
    methods: {
        registrar: function(){
            this.isLoading = true;
            this.erroresBack = null;

            authServicio.registrar({
                nombre: this.usuario.nombre,
                email: this.usuario.email,
                password: this.usuario.password,
                telefono: this.usuario.codigoArea + this.usuario.telefono,
            })
                .then(rta => {
                    if(rta.errors){
                        this.errores.nombre.error = false;
                        this.errores.email.error = false;
                        this.errores.password.error = false;
                        this.errores.telefono.error = false;
                        this.erroresBack = rta.errors;
                        this.isLoading = false;
                    }else{
                        this.isLoading = false;
                        this.$router.push('/')
                    }
                })

        },
        validar: function(campo){
            switch(campo){
                case 'nombre':
                    this.errores.nombre.error = false;
                    if(this.usuario.nombre.trim() === ''){
                        this.errores.nombre.error = true;
                    }
                    break;
                case 'email':
                    this.errores.email.error = false;
                    if(this.usuario.email.trim() === ''){
                        this.errores.email.error = true;
                    }
                    break;
                case 'password':
                    this.errores.password.error = false;
                    if(this.usuario.password.trim() === ''){
                        this.errores.password.error = true;
                        this.errores.password.mensaje = 'La contraseña es obligatoria';
                    }else if(this.usuario.password.lenght < 6){
                        this.errores.password.error = true;
                        this.errores.password.mensaje = 'La contraseña debe tener como mínimo 6 caracteres';
                    }
                    break;
                case 'telefono':
                    this.errores.telefono.error = false;
                    this.errores.codigoArea.error = false;
                    document.querySelector('form .form-group:last-of-type > div').classList.remove('error');
                    
                    if(this.usuario.codigoArea.trim() == ''){
                        this.errores.codigoArea.error = true;
                        document.querySelector('form .form-group:last-of-type > div').classList.add('error');
                    }
                    
                    this.errores.telefono.mensaje = 'El numero de celular es obligatorio';
                    if(this.usuario.telefono.trim() === ''){
                        this.errores.telefono.error = true;
                    }

                    if(
                    this.usuario.telefono.trim()[0] == '0' ||
                    this.usuario.telefono.includes('+') ||
                    this.usuario.telefono.includes('(') ||
                    this.usuario.telefono.includes(')') ||
                    this.usuario.telefono.includes('-') ||
                    this.usuario.telefono.includes(' ') ||
                    this.usuario.telefono.includes('/')
                    ){
                        this.errores.telefono.mensaje = 'Debe ingresar un formato de telefono válido (Ej: 1122223333)';
                        this.errores.telefono.error = true;
                    }
                    break;
                case 'codigoArea':
                    this.errores.codigoArea.error = false;
                    document.querySelector('form .form-group:last-of-type > div').classList.remove('error');
                    if(this.usuario.codigoArea.trim() == ''){
                        this.errores.codigoArea.error = true;
                        document.querySelector('form .form-group:last-of-type > div').classList.add('error');
                    }
                    break;               
            }
        }
    },
    computed:{
        isValid: function(){
            
            if(this.usuario.nombre.trim() === ''){
                return false
            }
            if(this.usuario.email.trim() === ''){
                return false
            }
            if(this.usuario.password.trim() === ''){
                return false
            }else if(this.usuario.password.lenght < 6){
                return false
            }
            if(this.usuario.telefono.trim() === ''){
                return false
            }

            if(
            this.usuario.telefono.trim()[0] == '0' ||
            this.usuario.telefono.includes('+') ||
            this.usuario.telefono.includes('(') ||
            this.usuario.telefono.includes(')') ||
            this.usuario.telefono.includes('-') ||
            this.usuario.telefono.includes(' ') ||
            this.usuario.telefono.includes('/')
            ){
                return false
            }

            if(this.usuario.codigoArea.trim() == ''){
                return false
            }

            return true
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
    data() {
        return {
            isLoading: false,
            
            verContra: false,

            erroresBack: null,
            
            errores:{
                nombre: {
                    error: false,
                    mensaje: 'El nombre es obligatorio'
                },
                email: {
                    error: false,
                    mensaje: 'El email es obligatorio'
                },
                password: {
                    error: false,
                    mensaje: 'La contraseña es obligatoria'
                },
                telefono: {
                    error: false,
                    mensaje: 'El numero de celular es obligatorio'
                },
                codigoArea: {
                    error: false,
                    mensaje: 'El código de país es obligatorio'
                },
            },
            usuario: {
                nombre: '',
                email: '',
                password: '',
                telefono: '',
                codigoArea: ''
            }
        }
    },
}
</script>
<style scoped>
    .registro-header > a{
        display: block;
        width: 1.5rem;
        height: 1.5rem;
        font-size: 0;
        background: url("../assets/icons/arrow.svg");
        background-size: contain;
        background-repeat: no-repeat;
        margin-top: .75rem;
        margin-bottom: 1rem;
    }

    .form-group > div{
        border: solid 1px #cecece;
        background-color: #fff;
        border-radius: 4px;
        display: flex;
        align-items: center;
    }

    form .form-group:last-of-type > div{
        background-color: transparent;
        border: 0;
        display: flex;
        align-items: stretch;
    }

    form .form-group:last-of-type > div > input:first-of-type{
        width: 15%;
        margin-right: .5rem;
        border-left: 0;
        border-radius: 0 4px 4px 0;
    }

    form .form-group:last-of-type > div::before{
        content: "+";
        border: solid 1px #cecece;
        display: block;
        padding: 1rem .5rem;
        padding-right: 0;
        background-color: #fff;
        border-right: 0;
        border-radius: 4px 0 0 4px;
    }

    form .form-group:last-of-type > div.error::before{
        border-color: rgba(255, 0, 0, .5);
    }
    
    form .form-group:last-of-type > div.error > input:first-of-type{
        border-color: rgba(255, 0, 0, .5);
    }
    
    .form-group > div > input{
        border: 0;
    }

    form .form-group:last-of-type > div > input{
        border: solid 1px #cecece;
        border-radius: 4px;
        padding-left: .25rem;
    }

    .form-group > div > span{
        margin-right: .5rem;
        color: #969696;
        font-size: 16px;
        font-weight: 600;
    }
    form .password-info{
        margin-top: .5rem;
        color: #969696;
    }
    label{
        color: #2b2b2b;
        font-weight: 800;
        font-size: 16px;
        padding-bottom: .5rem;
    }

    .btn{
        width: 100%;
        margin-top: 2rem;
        padding: .75rem 0;
    }
</style>