<template>
    <div>
        <Loader v-if="isLoading" />
        <div class="olvideContraHeader">
            <router-link to="/login">Volver</router-link>
            <h1>Reestablecer contraseña</h1>
        </div>

        <div>
            <p>Ingresá el email con el que estás registrado asi te enviamos un correo con las instrucciones a seguir.</p>

            <form action="#" method="POST" @submit.prevent="enviarEmailForm">
                <div class="form-group">
                    <label for="email">Ingresá tu email</label>
                    <input
                        v-model="email"
                        type="text"
                        id="email"
                        name="email"
                        placeholder="mail@ejemplo.com.ar"
                        @blur="limpiarEstado"
                    >
                </div>

                <button class="btn btn-primary">Enviar</button>
            </form>

            <div v-if="estado.mostrar" :class="'msj msj-' + estado.tipo">
                <p>{{estado.msj}}</p>
            </div>
        </div>
    </div>
</template>

<script>
import Loader from '../components/Loader.vue'
import authServicio from '../servicios/authServicio'

export default {
    name: 'OlvideContra',
    components: {
        Loader,
    },
    methods: {
        limpiarEstado: function(){
            this.estado.mostrar = false;
            this.estado.msj = '';
            this.estado.tipo = '';
        },
        enviarEmailForm: function(){
            this.limpiarEstado;

            this.isLoading = true;

            const emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if(!emailRegex.test(this.email)){
                this.estado.msj = 'El email ingresado no es válido, por favor ingresá uno correcto (nombre@dominio.extension)';
                this.estado.tipo = 'error';
                this.estado.mostrar = true;

                this.isLoading = false;

                return;
            }

            authServicio.generateToken({email: this.email})
                .then(res => {
                    this.isLoading = false
                    if (res.success){
                        this.$router.push('/olvide-mi-contra/codigo?email=' + this.email)
                    }else{
                        this.estado.msj = 'Ocurrió un error al intentar enviar el correo, por favor intentá de nuevo';
                        this.estado.tipo = 'error';
                        this.estado.mostrar = true;

                        if(res.msj){
                            this.estado.msj = res.msj
                        }
                    }

                })
        }
    },
    data() {
        return {
            email: '',
            isLoading: false,
            estado: {
                mostrar: false,
                msj: '',
                tipo: '',
            }
        }
    },
}
</script>

<style scoped>
.olvideContraHeader > a{
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

input{
    margin-bottom: 1rem;
}
</style>