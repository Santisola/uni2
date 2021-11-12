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
                    <input @blur="validar('nombre')" v-model="usuario.nombre" type="text" id="registro-nombre" name="nombre" placeholder="Nombre completo">
                </div>
                
                <div class="form-group">
                    <label for="registro-email">Email</label>
                    <input @blur="validar('email')" v-model="usuario.email" type="text" id="registro-email" name="email" placeholder="mail@ejemplo.com.ar">
                </div>
                
                <div class="form-group">
                    <label for="registro-password">Contraseña</label>
                    <div><input @blur="validar('password')" v-model="usuario.password" :type="verContra ? 'text' : 'password'" id="registro-password" name="email"><span @click="verContra = !verContra">{{verContra ? 'Ocultar' : 'Mostrar'}}</span></div>
                </div>
                <p class="password-info">Debe tener como mínimo 6 caracteres</p>

                <div class="form-group">
                    <label for="registro-celular">Celular</label>
                    <input @blur="validar('celular')" v-model="usuario.telefono" type="text" id="registro-celular" name="telefono" placeholder="+54 9 XXX XXXX-XXXX">
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
                        this.erroresBack = rta.errors;
                    }else{
                        this.$router.push('/login?registro=true')
                    }
                })

        },
        validar: function(campo){
            switch(campo){
                case 'nombre':
                    if(this.usuario.nombre.trim() === ''){
                        this.errores.nombre
                    }
                    break;
                case 'email':
                    break;
                case 'password':
                    break;
                case 'celular':
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
                celular: {
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