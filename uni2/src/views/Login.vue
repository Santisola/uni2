<template>
    <div id="login">
        <Loader v-if="isLoading" />
        <div class="login-header">
            <h1>Login</h1>
        </div>
        <div class="login-body">
            <p>Sumate a la comunidad de Unidos y reencontrate con tu mascota</p>
            <div v-if="$route.query.registro" class="msj msj-success">¡El registro fue un éxito! Iniciá sesión con tu nueva cuenta</div>
            <div v-if="errorServer !== null" class="msj msj-error">{{errorServer}}</div>
            <form action="#" @submit.prevent="login">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input :aria-describedby="errores.email.error ? 'error-email' : null" @blur="validar('email')" :disabled="isLoading" v-model="email" type="text" id="login-email" name="email">
                    <p id="error-email" class="msj msj-error" v-if="errores.email.error">{{errores.email.mensaje}}</p>
                </div>

                <div class="form-group">
                    <label for="login-password">Contraseña</label>
                    <div><input :aria-describedby="errores.password.error ? 'error-password' : null" @blur="validar('password')" :disabled="isLoading" v-model="password" :type="verContra ? 'text' : 'password'" id="login-password" name="email"><span @click="verContra = !verContra">{{verContra ? 'Ocultar' : 'Mostrar'}}</span></div>
                    <p id="error-password" class="msj msj-error" v-if="errores.password.error">{{errores.password.mensaje}}</p>
                </div>
                <router-link to="/olvide-mi-contra">Olvidé mi contraseña</router-link>
                <div class="btn-link">
                    <button :disabled="isLoading || errores.email.error || errores.password.error" :class="isLoading || errores.email.error || errores.password.error ? 'btn btn-disabled' : 'btn btn-primary'">Iniciar Sesión</button>
                    <p>¿No tenés cuenta? <router-link to="/registro"> Registrate</router-link></p>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import authServicio from '../servicios/authServicio';
import Loader from '../components/Loader.vue'

export default {
    name: "Login",
    components:{
        Loader
    },
    methods: {
        login: async function(){
            this.isLoading = true;
            this.errorServer = null;

            const data = {
                email: this.email,
                password: this.password,
                device_name: 'Dispositivo_de_' + this.email
            }
            
            const login = await authServicio.login(data);

            if(login.success){
                this.isLoading = false;
                this.$router.push('/');
            }else{
                this.password = '';
                if(login.errors){
                    let mensaje = ''
                    if(login.errors.email){
                        mensaje += login.errors.email;
                    }
                    if(login.errors.password){
                        if(login.errors.email){
                            mensaje += '. '
                        }
                        mensaje += login.errors.password;
                    }
                    this.errorServer = mensaje;
                    this.isLoading = false;
                }else{
                    this.errorServer = login.mensaje;
                    this.isLoading = false;
                }
            }
        },

        validar: function(campo){
            switch(campo){
                case 'email':
                    this.errores.email.error = false;
                    if(this.email.trim() === ''){
                        this.errores.email.error = true;
                    }
                    break;
                case 'password':
                    this.errores.password.error = false;
                    if(this.password.trim() === ''){
                        this.errores.password.error = true;
                    }
                    break;
            }
        }
    },
    data() {
        return {
            isLoading: false,
            verContra: false,

            email: '',
            password: '',

            errorServer: null,

            errores:{
                email: {
                    error: false,
                    mensaje: 'El email es obligatorio'
                },
                password: {
                    error: false,
                    mensaje: 'La contraseña es obligatoria'
                },
            },
        }
    },
}
</script>
<style scoped>
    .login-header{
        background: var(--secondary);
        margin: -1rem;
        height: 30vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-header h1{
        width: fit-content;
        text-align: center;
        width: 40%;
        height: 100px;
        font-size: 0;
        background: url("../assets/logo.svg");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .login-body{
        background-color: #fff; 
        margin: -1rem;
        margin-bottom: 0;
        width: 100%;
        padding: 1rem;
        border-radius: 16px 16px 0 0;
        position: absolute;
        bottom: 0;
        height: 72vh;
    }

    .login-body > p{
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 24px;
    }

    .form-group > label{
        padding-bottom: .5rem;
        font-style: normal;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        color: #222;
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

    form > a{
        color: var(--primary);
        display: block;
        width: fit-content;
        font-size: 14px;
        font-weight: 800;
        margin: 1rem 0;
    }

    .btn{
        width: 100%;
        padding: .75rem 0;
    }

    .btn-link p{
        color: #969696;
        font-size: 14px;
        text-align: center;
        padding: 1rem 0;
    }

    .btn-link a{
        color: var(--primary);
        font-weight: bold;
    }
</style>