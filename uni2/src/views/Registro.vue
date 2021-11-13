<template>
    <div>
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
                    <input :aria-describedby="errores.nombre.error ? 'error-nombre' : null" @blur="validar('nombre')" v-model="usuario.nombre" type="text" id="registro-nombre" name="nombre" placeholder="Nombre completo">
                    <p id="error-nombre" class="msj msj-error" v-if="errores.nombre.error">{{errores.nombre.mensaje}}</p>
                </div>
                
                <div class="form-group">
                    <label for="registro-email">Email</label>
                    <input :aria-describedby="errores.email.error ? 'error-email' : null" @blur="validar('email')" v-model="usuario.email" type="text" id="registro-email" name="email" placeholder="mail@ejemplo.com.ar">
                    <p id="error-email" class="msj msj-error" v-if="errores.email.error">{{errores.email.mensaje}}</p>
                </div>
                
                <div class="form-group">
                    <label for="registro-password">Contraseña</label>
                    <div><input :aria-describedby="errores.password.error ? 'error-password' : null" @blur="validar('password')" v-model="usuario.password" :type="verContra ? 'text' : 'password'" id="registro-password" name="email"><span @click="verContra = !verContra">{{verContra ? 'Ocultar' : 'Mostrar'}}</span></div>
                    <p id="error-password" class="msj msj-error" v-if="errores.password.error">{{errores.password.mensaje}}</p>
                </div>
                <p class="password-info">Debe tener como mínimo 6 caracteres</p>

                <div class="form-group">
                    <label for="registro-celular">Celular</label>
                    <input :aria-describedby="errores.telefono.error ? 'error-telefono' : null" @blur="validar('telefono')" v-model="usuario.telefono" type="text" id="registro-celular" name="telefono" placeholder="+54 9 XXX XXXX-XXXX">
                    <p id="error-telefono" class="msj msj-error" v-if="errores.telefono.error">{{errores.telefono.mensaje}}</p>
                </div>

                <button class="btn btn-primary">Registrarme</button>
            </form>
        </div>
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';
export default {
    name: "Registro",
    methods: {
        registrar: function(){
            this.erroresBack = null;

            authServicio.registrar(this.usuario)
                .then(rta => {
                    if(rta.errors){
                        this.errores.nombre.error = false;
                        this.errores.email.error = false;
                        this.errores.password.error = false;
                        this.errores.telefono.error = false;
                        this.erroresBack = rta.errors;
                    }else{
                        this.$router.push('/login?registro=true')
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
                    if(this.usuario.telefono.trim() === ''){
                        this.errores.telefono.error = true;
                    }
                    break;
            }
        }
    },
    computed:{
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
            },
            usuario: {
                nombre: '',
                email: '',
                password: '',
                telefono: '',
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

    .form-group > div > input{
        border: 0;
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
        width: calc(100% - 2rem);
        padding: .75rem 0;
        position: absolute;
        bottom: 15px;
    }
</style>