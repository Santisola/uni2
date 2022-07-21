<template>
    <div>

        <Loader v-if="isLoading" />
        <div v-if="alerta">
            <!-- <h1 v-if="alerta.nombre">Editar alerta de "{{alerta.nombre}}"</h1> -->
            <h1>Editar alerta</h1>



            <form autocomplete="off" @submit.prevent="editar" action="#" method="post">
                <div id="perdida-paso-1">
                    <h2>Especie</h2>
                    <div class="form-grup radio-group">
                        <div :class="alerta.id_especie == 1 ? 'radio-item radio-active' : 'radio-item'">
                            <input
                                v-bind:checked="alerta.id_especie == 1"
                                v-model="alerta.id_especie"
                                :aria-describedby="errores.especie.error ? 'error-especie' : null"
                                :value="1"
                                type="radio"
                                name="especie"
                                id="perro"
                            >
                            <label for="perro">Perro</label>
                        </div>
                        <div :class="alerta.id_especie == 2 ? 'radio-item radio-active' : 'radio-item'">
                            <input
                                v-bind:checked="alerta.id_especie == 2"
                                v-model="alerta.id_especie"
                                :aria-describedby="errores.especie.error ? 'error-especie' : null"
                                :value="2"
                                type="radio"
                                name="especie"
                                id="gato"
                            >
                            <label for="gato">Gato</label>
                        </div>
                        <p
                            v-if="errores.especie.error"
                            id="error-especie"
                            class="msj msj-error"
                        >{{errores.especie.mensaje}}</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="raza">Raza</label>
                        <select
                            v-model="alerta.id_raza"
                            :aria-describedby="errores.raza.error ? 'error-raza' : null"
                            name="raza"
                            id="raza"
                            @blur="validar('raza')"
                        >
                            <option
                                v-for="(raza, index) in razas"
                                v-bind:selected="alerta.id_raza==raza.id_raza"
                                :key="index"
                                :value="raza.id_raza"
                            >{{raza.raza}}</option>
                        </select>
                        <p
                            v-if="errores.raza.error"
                            id="error-raza"
                            class="msj msj-error"
                        >{{errores.raza.mensaje}}</p>
                    </div>
                    
                    <h2>Sexo</h2>
                    <div class="form-group radio-group sexo-container">
                        <div class="radio-item">
                            <input
                                v-model="alerta.id_sexo"
                                :aria-describedby="errores.sexo.error ? 'error-sexo' : null"
                                :value="1"
                                :checked="alerta.id_sexo == 1"
                                type="radio"
                                name="sexo"
                                id="macho"
                                @blur="validar('sexo')"
                            >
                            <label for="macho">Macho</label>
                        </div>
                        <div class="radio-item">
                            <input
                                v-model="alerta.id_sexo"
                                :aria-describedby="errores.sexo.error ? 'error-sexo' : null"
                                :checked="alerta.id_sexo == 2"
                                :value="2"
                                type="radio"
                                name="sexo"
                                id="hembra"
                                @blur="validar('sexo')"
                            >
                            <label for="hembra">Hembra</label>
                        </div>
                        <p
                            v-if="errores.sexo.error"
                            id="error-sexo"
                            class="msj msj-error"
                        >{{errores.sexo.mensaje}}</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input
                            :aria-describedby="errores.nombre.error ? 'error-nombre' : null"
                            @blur="validar('nombre')"
                            v-model="alerta.nombre"
                            type="text"
                            name="nombre"
                            id="nombre"
                            placeholder="Nombre de tu mascota"
                        >
                        <p
                            v-if="errores.nombre.error"
                            id="error-nombre"
                            class="msj msj-error"
                        >{{errores.nombre.mensaje}}</p>
                    </div>
                    
                </div>
                <div id="perdida-paso-2">
                    <!-- ACA VA A IR EL MAPA -->
                    <h2>Direccion actual:</h2>
                    <Direccion :lat="alerta.latitud" :lng="alerta.longitud" />

                    <input type="checkbox" id="editaDireccion" v-model="editaDireccion">
                    <label id="editaDireccionLabel" :class="editaDireccion ? 'si' : 'no'" for="editaDireccion">Quiero editar la dirección</label>

                    <div v-if="editaDireccion" class="form-group">
                        <label for="autocomplete">Nueva dirección</label>
                        <div id="direccion">
                            <input
                                v-bind:disabled="direccionExitosa"
                                :aria-describedby="errores.direccion.error ? 'error-direccion' : null"
                                :value="direccion"
                                type="text"
                                name="direccion"
                                id="autocomplete"
                                placeholder="Soler 5868, Buenos Aires"
                                @blur="validar('direccion')"
                                @input="e => direccion = e.target.value"
                                @keyup="autocomplete"
                            >
                            <a
                                v-if="direccionExitosa"
                                href="#"
                                @click.prevent="direccionExitosa = null"
                            >X</a>
                            <button
                                :class="direccionExitosa ? 'exito' : ''"
                                @click.prevent="actualizarDireccion(null)"
                            >Buscar</button>
                        </div>
                        <ul
                            id="suggestions"
                            v-if="showSuggestions && direccion !== ''"
                        >
                            <li
                                v-for="(suggestion, index) in suggestions"
                                :key="index"
                                @click="actualizarDireccion(suggestion)"
                            >{{suggestion.title}}</li>
                        </ul>
                        <p
                            v-if="errores.direccion.error"
                            id="error-direccion"
                            class="msj msj-error"
                        >{{errores.direccion.mensaje}}</p>
                    </div>

                    <!-- <div class="form-group">
                        <label for="extraDireccion">Más información del lugar</label>
                        <input v-model="extraDireccion" type="text" name="extraDireccion" id="extraDireccion" placeholder="Ej. Entre las calles...">
                    </div> -->
                </div>
                <div id="perdida-paso-3">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input
                            v-model="alerta.fecha"
                            :aria-describedby="errores.fecha.error ? 'error-fecha' : null"
                            type="date"
                            name="fecha"
                            id="fecha"
                            placeholder="Domingo 18 de julio, 2021"
                            @blur="validar('fecha')"
                        >
                        <p
                            v-if="errores.fecha.error"
                            id="error-fecha"
                            class="msj msj-error"
                        >{{errores.fecha.mensaje}}</p>
                    </div>

                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input
                            :aria-describedby="errores.hora.error ? 'error-hora' : null"
                            @blur="validar('hora')"
                            v-model="alerta.hora"
                            type="time"
                            name="hora"
                            id="hora"
                            placeholder="Ingresá la hora"
                        >
                        <p
                            v-if="errores.hora.error"
                            id="error-hora"
                            class="msj msj-error"
                        >{{errores.hora.mensaje}}</p>
                    </div>
                </div>
                <div id="perdida-paso-4">
                    <div class="form-group">
                        <h2>Imagenes actuales</h2>
                        <ImagenesAlerta :imgs="alerta.imagenes" :esParaEditar="true"/>
                        
                        <label for="fotos">Cambiar imagen</label>
                        
                        <div id="agregarFoto" @click="elegirFoto = true"></div>

                        <div id="opcionesFoto" v-if="elegirFoto">
                            <div>
                                <h3>¿Cómo querés subir las fotos?</h3>
                                <div id="lasOpciones">
                                    <div id="camara">
                                        <button id="fotosCelu" @click.prevent="sacarFoto">Sacar Foto</button>
                                        <p>Cámara</p>
                                    </div>

                                    <div id="archivos">
                                        <div id="inputFile">
                                            <input
                                                type="file"
                                                id="fotos"
                                                ref="imagen"
                                                capture="environment"
                                                accept="image/*"
                                                multiple
                                                @change="cargarImg"
                                            >
                                        </div>
                                        <p>Archivos</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="imagenPerdida.length != 0">
                            <h3>Imagenes seleccionadas</h3>
                            
                            <div id="selectedImgsList">
                                <img
                                    v-for="(img, index) in imagenPerdida" :key="index"
                                    width="148"
                                    height="148"
                                    style="object-fit: contain;"
                                    :src="img" :alt="'Mascota ' + nombre"
                                >
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Características de tu mascota</label>

                        <textarea
                            v-model="alerta.descripcion"
                            :aria-describedby="errores.descripcion.error ? 'error-descripcion' : null"
                            id="descripcion"
                            rows="6"
                            cols="10"
                            placeholder="ej. Tiene una manchita negra en la nariz..."
                            @blur="validar('descripcion')"
                        >
                        </textarea>
                        <p
                            v-if="errores.descripcion.error"
                            id="error-descripcion"
                            class="msj msj-error"
                        >{{errores.descripcion.mensaje}}</p>
                    </div>
                </div>
                

                <div v-if="erroresBack !== null" class="msj msj-error">
                    <ul>
                        <li v-for="(error, index) in erroresBackArray" :key="index">{{error}}</li>
                    </ul>
                </div>
                
                <input type="submit" class="btn btn-primary">
            </form>




        </div>
    </div>
</template>
<script>
import alertasServicio from '../servicios/alertasServicio';
import ImagenesAlerta from '../components/ImagenesAlerta.vue';
import Direccion from '../components/Direccion.vue';
import Loader from '../components/Loader.vue';
import {HERE_API_KEY} from '../constantes/index';

export default {
    name: "EditarAlerta",
    components:{
        ImagenesAlerta,
        Direccion,
        Loader
    },
    beforeMount() {
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                setUserLocation(`${position.coords.latitude},${position.coords.longitude}`)
            });
        }else{
            setUserLocation('-34.611000283089865,-58.447376624867765')
        }
        const setUserLocation = (lngLat) => {
            this.userLocation = lngLat
        }
    },
    mounted() {
        this.platform = new H.service.Platform({
            apikey: this.apikey
        });

        this.service = this.platform.getSearchService();
        
        this.isLoading = true;
        alertasServicio.get(this.$route.params.id).then(res => {
            this.alerta = res;
            this.isLoading = false;
        });
        alertasServicio.getRazas().then(res => {this.razas = res});
    },
    methods: {
        sacarFoto: function(){
            this.elegirFoto = false
            navigator.camera.getPicture(this.camaraSuccess, this.camaraError, {
                saveToPhotoAlbum: true,
                correctOrientation: true,
                destinationType: Camera.DestinationType.DATA_URL
            })
        },
        camaraSuccess: function(imageData){
            this.imagenPerdida.push("data:image/jpeg;base64," + imageData);
        },
        camaraError: function(msj){
            this.errorCamara.error = true;
            this.errorCamara.msj = 'Ocurrió un error al intentar usar la cámara, por favor intentá de nuevo';

            console.error('ERROR CAMARA: ', msj)
        },
        autocomplete: function(){
            if(this.direccion !== ''){
                this.service.autosuggest({
                    at: this.userLocation ? this.userLocation : '-34.611000283089865,-58.447376624867765',
                    limit: 5,
                    q: this.direccion
                }, (res) => {
                    console.log(res)
                    this.suggestions = res.items;
                    if(res.items.length > 0) this.showSuggestions = true;
                }, (err) => {
                    this.suggestions = [];
                    this.showSuggestions = false;
                    console.error(err);
                })
            }
        },
        actualizarDireccion: function(suggestion){
            if(suggestion !== null){
                this.direccion = suggestion.title;

                this.latitud = suggestion.position.lat;
                this.longitud = suggestion.position.lng;

            } else{
                console.log(this.suggestions[0])
                this.direccion = this.suggestions[0].title;

                this.latitud = this.suggestions[0].position.lat;
                this.longitud = this.suggestions[0].position.lng;
            }
            
            this.direccionExitosa = true;
            this.showSuggestions = false;
            this.suggestions = [];  
        },
        editar: function (){
            this.isLoading = true;
            const data = {
                nombre: this.alerta.nombre,
                descripcion: this.alerta.descripcion,
                fecha: this.alerta.fecha,
                hora: this.alerta.hora,
                imagenes: this.imagenPerdida, /*****/
                latitud: this.alerta.latitud,
                longitud: this.alerta.longitud,
                id_usuario: this.alerta.id_usuario,
                id_especie: this.alerta.id_especie,
                id_raza: this.alerta.id_raza,
                id_sexo: this.alerta.id_sexo,
                id_tipoalerta: this.alerta.id_tipoalerta,
                id_alerta: this.alerta.id_alerta
            }

            alertasServicio.editar(data, this.alerta.id_alerta).then(res => {
                if(res.success){
                    this.isLoading = false;
                    this.$router.push(`/alertas/${this.alerta.id_alerta}`)
                }else{
                    if(res.errors){
                        this.isLoading = false;
                        this.erroresBack = res.errors
                    }
                }
            });
        },
        cargarImg: function (){
            this.elegirFoto = false
            for(let i = 0; i < this.$refs.imagen.files.length; i++){
                const reader = new FileReader();

                reader.addEventListener('load', () => {
                    this.imagenPerdida.push(reader.result);
                })

                reader.readAsDataURL(this.$refs.imagen.files[i]);
            }
        },
        validar: function(campo){
            switch(campo){
                //Paso 1
                case 'especie':
                    this.errores.especie.error = false;
                    if(this.id_especie){
                        this.errores.especie.error = true;
                    }
                    break;
                case 'raza':
                    this.errores.raza.error = false;
                    if(this.id_raza){
                        this.errores.raza.error = true;
                    }
                    break;
                case 'sexo':
                    this.errores.sexo.error = false;
                    if(this.id_sexo){
                        this.errores.sexo.error = true;
                    }
                    break;
                case 'nombre':
                    this.errores.nombre.error = false;
                    if(this.alerta.nombre.trim() === ''){
                        this.errores.nombre.error = true;
                    }
                    break;
                //Paso 2
                case 'direccion':
                    this.errores.direccion.error = false;
                    if(this.alerta.direccion.trim() === ''){
                        this.errores.direccion.error = true;
                    }
                    break;
                //Paso 3
                case 'fecha':
                    this.errores.fecha.error = false;
                    if(this.alerta.fecha.trim() === ''){
                        this.errores.fecha.error = true;
                    }
                    break;
                case 'hora':
                    this.errores.hora.error = false;
                    if(this.alerta.hora.trim() === ''){
                        this.errores.hora.error = true;
                    }
                    break;
                //Paso 4
                case 'descripcion':
                    this.errores.descripcion.error = false;
                    if(this.alerta.descripcion.trim() === ''){
                        this.errores.descripcion.error = true;
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
        },
        isValid() {
            if(!this.selectedEspecie){
                return false;
            }
            if(!this.selectedRaza){
                return false;
            }
            if(!this.selectedSexo){
                return false;
            }
            if(!this.nombre){
                return false;
            }
            if(!this.direccion){
                return false;
            }
            if(!this.fecha){
                return false;
            }
            if(!this.hora){
                return false;
            }
            if(!this.imagenPerdida){
                return false;
            }
            if(!this.descripcion){
                return false;
            }
            return true
        },
        razasFiltradas: function(){
            if(this.selectedEspecie !== null){

                return this.razas.filter(raza => raza.id_especie == this.selectedEspecie);

            }
            return false;
        },
        razaName() {
            let nombreRaza = ''
            this.razas.map(raza => {
                if(raza.id_raza === this.selectedRaza){
                    nombreRaza = raza.raza
                }
            })
            return nombreRaza;
        },
        sexoName() {
            if(this.selectedSexo === 1) {
                return 'Macho';
            } else if(this.selectedSexo === 2){
                return 'Hembra';
            }
            return false;
        },
        especieName() {
            if(this.selectedEspecie === 1) {
                return 'Perro';
            } else if(this.selectedEspecie === 2){
                return 'Gato';
            }
            return false;
        }
    },
    data() {
        return {
            direccion: '',
            direccionExitosa: null,

            apikey: HERE_API_KEY,
            platform: null,
            service: null,
            userLocation: null,
            showSuggestions: false,
            suggestions: [],
            
            editaDireccion: false,
            
            isLoading: false,
            alerta: null,

            elegirFoto: false,
            imagenPerdida: [],
            
            razas:[],

            erroresBack: null,
            errores:{
                especie: {
                    error: false,
                    mensaje: 'La especie es obligatoria'
                },
                raza: {
                    error: false,
                    mensaje: 'La raza es obligatoria'
                },
                sexo: {
                    error: false,
                    mensaje: 'El sexo es obligatorio'
                },
                nombre: {
                    error: false,
                    mensaje: 'El nombre de la mascota es obligatorio'
                },

                direccion: {
                    error: false,
                    mensaje: 'La dirección es obligatoria'
                },

                fecha: {
                    error: false,
                    mensaje: 'La fecha es obligatoria'
                },
                hora: {
                    error: false,
                    mensaje: 'La hora es obligatoria'
                },

                descripcion: {
                    error: false,
                    mensaje: 'La descripción es obligatoria'
                },
            },
        }
    },
}
</script>
<style scoped>

h2,
.form-group > label{
    font-size: 16px;
    font-weight: 600;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #222;
    margin-top: 1rem;
}

.form-group > label{
    padding: 0;
    padding-bottom: .5rem;
}

.radio-group{
    display: flex;
}

.radio-item{
    border: solid 1px #cecece;
    width: 33%;
    padding: 1rem;
    border-radius: 4px;
    margin-top: .5rem;
    margin-right: .5rem;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.radio-active{
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.sexo-container{
    justify-content: space-between;
    flex-wrap: wrap;
}

.sexo-container > div{
    width: 48%;
    margin-right: 0;
}

.sexo-container > p{
    width: 100%;
}

#direccion{
    display: flex;
}

#direccion > a{
    display: block;
    border-top: solid 1px #cecece;
    border-bottom: solid 1px #cecece;
    display: flex;
    align-items: center;
    padding: 0 .5rem;
}

#autocomplete{
    border: solid 1px #cecece;
    border-right: 0;
    border-radius: 4px 0 0 4px;
}

#autocomplete ~ button{
    border: solid 1px var(--primary);
    border-left: 0;
    border-radius: 0 4px 4px 0;
    background: var(--primary);
    color: #fff;
    font-size: 0;
    width: 15%;
    display: flex;
    justify-content: center;
    align-items: center;
}

#autocomplete ~ button:active{
    background: #2d0de0;
}

#autocomplete ~ button::after{
    content: "";
    transform: rotate(45deg);
    width: 10px;
    height: 10px;
    margin-left: -5px;
    border-top: solid 2px #fff;
    border-right: solid 2px #fff;
    transition: all 250ms ease;
}

#autocomplete ~ button.exito{
    background: #00cf3f;
    border-color: #00cf3f;
}

#autocomplete ~ button.exito::after{
    transform: rotate(135deg);
    width: 20px;
    margin-top: -7px;
    margin-left: 0;
}

#suggestions{
    background: #fff;
    position: absolute;
    left: 1rem;
    right: 1rem;
    border-radius: 0 0 10px 10px;
    box-shadow: 2px 2px 7px rgba(0, 0, 0, 0.4);
}

#suggestions li{
    padding: .75rem 1rem;
    border-bottom: solid 1px rgba(0, 0, 0, 0.1);
}

#suggestions li:active{
    background-color: #eee;
}

#fotos{
    background: #fff;
    width: 150px;
    height: 150px;
    position: relative;
}

input#fotos::before {
    content: "+";
    color: var(--primary);
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    font-size: 32px;
    border-radius: 50%;
    border: solid 2px;
    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
}

input#fotos::after {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    content: "";
    background: #fff;
}

#perdida-paso-4 .imgContainer >>> img{
    width: 148px;
    height: 148px;
    object-fit: contain;
}

.direccionBien{
    font-size: 18px;
    margin: .5rem 0;
}

#editaDireccion{
    position: absolute;
    visibility: hidden;
}

#editaDireccionLabel{
    font-size: 20px;
    display: flex;
    align-items: center;
}

#editaDireccionLabel::before{
    content: "✔";
    background: #fff;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 25px;
    height: 25px;
    margin-right: 5px;
    border: solid 1px #cecece;
    border-radius: 4px;
    transition: all 150ms ease;
}

#editaDireccionLabel.si::before{
    background: var(--primary);
}

.btn{
    margin: 1rem 0;
}

#agregarFoto{
    background: #fff;
    width: 150px;
    height: 150px;
    position: relative;
    border: solid 1px #cecece;
    flex-shrink: 0;
    margin-bottom: 1.5rem;
}

#agregarFoto::after{
    content: "+";
    color: var(--primary);
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    font-size: 32px;
    border-radius: 50%;
    border: solid 2px;
    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#opcionesFoto{
    position: fixed;
    inset: 0;
    z-index: 999;
    background: rgba(0, 0, 0, 0.2);
}
#opcionesFoto > div{
    background: #fff;
    position: fixed;
    z-index: 1000;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 1rem;
    padding-bottom: 2rem;
    border-radius: 4px 4px 0 0;
    box-shadow: 0 -1px 5px rgb(0 0 0 / 25%);
    transition: all 250ms ease;
    animation: showUp 250ms;
}

@keyframes showUp {
    0%{
        bottom: -100%;
    }
    100%{
        bottom: 0;
    }
}

#lasOpciones{
    display: flex;
    align-items: center;
    margin-top: 1rem;
}

#camara,
#archivos{
    display: flex;
    flex-direction: column;
    align-items: center;
}

#archivos{
    margin-left: 2rem;
}

#inputFile{
    width: 50px;
    height: 50px;
    border: solid 1px #ccc;
    border-radius: 4px;
    margin-bottom: 0.5rem;
    background: url("../assets/icons/files.svg") center/25px no-repeat;
}

#inputFile > input{
    opacity: 0;
}

#fotosCelu{
    width: 50px;
    height: 50px;
    font-size: 0;
    background: url("../assets/icons/camera.svg") center/25px no-repeat;
    background-color: transparent;
    border: solid 1px #ccc;
    border-radius: 4px;
    margin-bottom: 0.5rem;
}

#selectedImgsList{
    display: flex;
    align-items: center;
    width: 100%;
    overflow-x: auto;
}

#selectImgsContainer img{
    display: block;
    margin-right: 1rem;
}
</style>