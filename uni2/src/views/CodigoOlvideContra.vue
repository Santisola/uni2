<template>
    <div>
        <Loader v-if="isLoading" />
        <div v-if="!reestableceContra" id="validarToken">  
            <div class="olvideContraHeader">
                <router-link to="/olvide-mi-contra">Volver</router-link>
                <h2>Ingresá el código que te enviamos por correo</h2>
                <p>¡Ingresá el código para poder reestablecer tu contraseña!</p>
            </div>
        
            
            <form action="#" method="POST" @submit.prevent="validarToken">
                <div id="inputsContainer">
                    <input
                        type="text"
                        name="codigo1"
                        id="codigo1"
                        maxlength="1"
                        v-model="codigo1"
                        placeholder="-"
                        @input="changeFocus"
                    >
                    <input
                        type="text"
                        name="codigo2"
                        id="codigo2"
                        maxlength="1"
                        v-model="codigo2"
                        placeholder="-"
                        @input="changeFocus"
                    >
                    <input
                        type="text"
                        name="codigo3"
                        id="codigo3"
                        maxlength="1"
                        v-model="codigo3"
                        placeholder="-"
                        @input="changeFocus"
                    >
                    <input
                        type="text"
                        name="codigo4"
                        id="codigo4"
                        maxlength="1"
                        v-model="codigo4"
                        placeholder="-"
                        @input="changeFocus"
                    >
                    <input
                        type="text"
                        name="codigo5"
                        id="codigo5"
                        maxlength="1"
                        v-model="codigo5"
                        placeholder="-"
                        @input="changeFocus"
                    >
                    <input
                        type="text"
                        name="codigo6"
                        id="codigo6"
                        maxlength="1"
                        v-model="codigo6"
                        placeholder="-"
                        @input="changeFocus"
                    >
                </div>
                <div><button class="btn btn-primary">Validar</button></div>
            </form>
            <div v-if="error">
                <p class="msj msj-error">El código ingresado no es válido, por favor ingresá el código que te enviamos por correo</p>
            </div>
        </div>
        <div v-else id="reestablecerContra">
            <div class="olvideContraHeader">
                <router-link to="/olvide-mi-contra">Volver</router-link>
                <h1>Reestablecer contraseña</h1>
            </div>

            <div>
                <p>¡Ya casi está todo! Ingresá tu nueva contraseña</p>

                <form action="#" method="POST" @submit.prevent="reestablecerContra" v-if="!exito">
                    <div class="form-group">
                        <label for="contra">Contraseña</label>
                        <input
                            v-model="contra"
                            :type="ver ? 'text' : 'password'"
                            id="contra"
                            name="contra"
                            @blur="validar('contra')"
                        >

                        <div class="msj msj-error" v-if="errores.contra">
                            <p>La contraseña es obligatoria</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmContra">Confirmá tu contraseña</label>
                        <input
                            v-model="confirmContra"
                            :type="ver ? 'text' : 'password'"
                            id="confirmContra"
                            name="confirmContra"
                            @blur="validar('confirmContra')"
                        >

                        <div class="msj msj-error" v-if="errores.confirmContra">
                            <p>Tenés que confirmar tu contraseña</p>
                        </div>
                    </div>

                    <a id="showHide" href="#" @click.prevent="ver = !ver">{{ ver ? 'Ocultar' : 'Mostrar'}}</a>

                    <div class="msj msj-error" v-if="noCoinciden">
                        <p>Las contraseñas no coinciden</p>
                    </div>

                    <button class="btn btn-primary">Enviar</button>
                </form>
                <div class="msj msj-success" v-if="exito">
                    <p>¡Se reestableció tu contraseña con éxito! <router-link id="back-to-login" to="/login">Iniciar sesión</router-link></p>
                </div>
                <div class="msj msj-error" v-if="errorFinal">
                    <p>Ocurrió un error al intentar reestablecer tu contraseña, por favor intentá de nuevo</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import authServicio from '../servicios/authServicio';
import Loader from '../components/Loader.vue'

export default {
    name: 'CodigoOlvideContra',
    components: {
        Loader,
    },
    methods: {
        changeFocus: (ev) => {
            const target = ev.target.nextElementSibling;
            if(target){
                target.focus();
                target.select();
            }
        },
        validarToken: async function() {
            this.error = false;
            this.isLoading = true;

            const token = this.codigo1 + this.codigo2 + this.codigo3 + this.codigo4 + this.codigo5 + this.codigo6;
            const data = {
                email: this.$route.query.email,
                token: token
            }

            const res = await authServicio.validateToken(data);

            if(res.valido){
                this.isLoading = false;
                this.reestableceContra = true
            }else{
                this.isLoading = false;
                this.error = true;
            }
        },
        reestablecerContra: async function(){
            this.isLoading = true;
            this.noCoinciden = false;
            this.errorFinal = false;
            
            const email = this.$route.query.email;

            if(!this.errores.contra && !this.errores.confirmContra){
                if(this.contra.trim() !== this.confirmContra.trim()){
                    this.noCoinciden = true;
                    this.isLoading = false;
                    return;
                }     
                
                const data = {
                    email: email,
                    contra: this.contra,
                    contra2: this.confirmContra
                }

                const res = await authServicio.reestablecerContra(data);

                if(res.success){
                    this.isLoading = false;
                    this.exito = true;
                }else{
                    this.isLoading = false;
                    this.errorFinal = true;
                }
            }
        },
        validar: function(campo){
            if(campo == 'contra'){
                this.errores.contra = false;
                if(!this.contra.trim()){
                    this.errores.contra = true;
                }
            }
            
            if(campo == 'confirmContra'){
                this.errores.confirmContra = false;
                if(!this.confirmContra.trim()){
                    this.errores.confirmContra = true;
                }
            }
        }
    },
    data() {
        return {
            isLoading: false,
            error: false,
            
            codigo1: '',
            codigo2: '',
            codigo3: '',
            codigo4: '',
            codigo5: '',
            codigo6: '',

            reestableceContra: false,

            ver: false,
            
            contra: '',
            confirmContra: '',

            noCoinciden: false,

            errores: {
                contra: false,
                confirmContra: false,
            },

            exito: false,
            errorFinal: false,
        }
    },
}
</script>

<style scoped>
#validarToken .olvideContraHeader > a{
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

#validarToken h2{
    margin-bottom: .5rem;
}

#validarToken #inputsContainer{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-top: 2rem;
}

#validarToken #inputsContainer > input{
    display: block;
    width: 15%;
    min-width: 2rem;
    font-size: 1.25rem;
    padding: 1.25rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: solid 1px #cecece;
    border-radius: 4px;
    color: #2b2b2b;
    font-family: 'Montserrat';
}

#validarToken form > div:last-of-type{
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
}

#reestablecerContra .olvideContraHeader > a{
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

#reestablecerContra label{
    margin-top: 0;
}

#reestablecerContra button{
    margin-top: 1.5rem;
}

#reestablecerContra #showHide{
    display: block;
    font-weight: bold;
    color: var(--primary);
    text-decoration: underline;
    margin-top: 1rem;
}

#back-to-login{
    text-decoration: underline;
    font-weight: bold;
}
</style>