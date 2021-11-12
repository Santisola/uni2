<template>
    <div>
        <div v-if="success === null" class="form-nueva-header">
            <span @click="paso > 0 ? paso-- : ''">Volver</span>
            <div class="form-nueva-title">
                <h1>{{pasos[paso].titulo}}</h1>
                <p v-if="paso < 4">Siguiente: {{pasos[paso+1].titulo}}</p>
                <p v-else>y publicá el aviso</p>
            </div>
            <div>
                <p>{{pasos[paso].id}} de 5</p>
            </div>
        </div>
        <form v-if="success === null" @submit.prevent="crear" action="#" method="post">
            <div id="perdida-paso-1" v-if="paso === 0">
                <h2>Especie</h2>
                <div class="form-grup radio-group">
                    <div class="radio-item radio-active">
                        <input v-model="selectedEspecie" checked type="radio" name="especie" id="perro" :value="1">
                        <label for="perro">Perro</label>
                    </div>
                    <div class="radio-item">
                        <input v-model="selectedEspecie" disabled type="radio" name="especie" id="gato" :value="2">
                        <label for="gato">Gato</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="raza">Raza</label>
                    <select v-model="selectedRaza" name="raza" id="raza">
                        <option v-for="(raza, index) in razas" :key="index" :value="raza.id_raza">{{raza.raza}}</option>
                    </select>
                </div>
                
                <h2>Sexo</h2>
                <div class="form-group radio-group sexo-container">
                    <div class="radio-item">
                        <input v-model="selectedSexo" type="radio" name="sexo" id="macho" :value="1">
                        <label for="macho">Macho</label>
                    </div>
                    <div class="radio-item">
                        <input v-model="selectedSexo" type="radio" name="sexo" id="hembra" :value="2">
                        <label for="hembra">Hembra</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input v-model="nombre" type="text" name="nombre" id="nombre" placeholder="Nombre de tu mascota">
                </div>
                
            </div>
            <div id="perdida-paso-2" v-if="paso === 1">
                <!-- ACA VA A IR EL MAPA -->

                <div class="form-group">
                    <label for="autocomplete">Dirección</label>
                    <div id="direccion">
                        <input v-bind:disabled="direccionExitosa" v-model="direccion" type="text" name="direccion" id="autocomplete" placeholder="Soler 5868, Buenos Aires"><a href="#" @click.prevent="direccionExitosa = null" v-if="direccionExitosa">X</a>
                        <button :class="direccionExitosa ? 'exito' : ''" @click.prevent="actualizarDireccion">Buscar</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="extraDireccion">Más información del lugar</label>
                    <input v-model="extraDireccion" type="text" name="extraDireccion" id="extraDireccion" placeholder="Ej. Entre las calles...">
                </div>
            </div>
            <div id="perdida-paso-3" v-if="paso === 2">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input v-model="fecha" type="date" name="fecha" id="fecha" placeholder="Domingo 18 de julio, 2021">
                </div>

                <div class="form-group">
                    <label for="hora">Hora</label>
                    <input v-model="hora" type="time" name="hora" id="hora" placeholder="Ingresá la hora">
                </div>
            </div>
            <div id="perdida-paso-4" v-if="paso === 3">
                <div class="form-group">
                    <label for="fotos">Seleccioná las fotos</label>
                    <input v-if="imagenPerdida === null" type="file" id="fotos" ref="imagen" @change="cargarImg">
                    <img
                    v-else
                    width="148"
                    height="148"
                    style="object-fit: contain;"
                    :src="imagenPerdida" :alt="'Mascota perdida ' + nombre">
                </div>

                <div class="form-group">
                    <label for="descripcion">Características de tu mascota</label>
                    <p>Escribí cualquier rasgo o detalle de tu mascota que facilite su reconocimiento.</p>
                    <textarea id="descripcion" rows="6" cols="10" v-model="descripcion" placeholder="ej. Tiene una manchita negra en la nariz...">
                    </textarea>
                </div>
            </div>
            <div id="perdida-paso-5" v-if="paso === 4">
                <h2>Información de la mascota</h2>
                <p>Asegurate que todo esté de forma correcta. <br> Luego podrás editar el aviso si necesitás</p>

                <article>
                    <div class="top">
                        <div class="content">
                            <ul>
                                <li>{{nombre}}</li>
                                <li>{{razaName}}</li>
                                <li>
                                    <span>{{especieName}}</span>
                                    <span>{{sexoName}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="img">
                            <img
                            width="100"
                            height="100"
                            style="object-fit: contain;"
                            :src="imagenPerdida" :alt="'Mascota perdida ' + nombre">
                        </div>
                    </div>
                    <div class="bottom">
                        <ul>
                            <li><span>{{fecha}}</span><span>{{hora}}</span></li>
                            <li>{{direccion}}</li>
                        </ul>
                    </div>
                </article>
            </div>

            <div id="form-controls">
                <span class="btn-secondary" @click="paso > 0 ? paso-- : ''">Volver</span>
                <span v-if="paso !== 4" :class="isValid ? 'btn btn-primary' : 'btn btn-disabled'" @click="paso < 4 ? paso++ : ''">Siguiente</span>
                <input type="submit" value="Publicar" class="btn btn-primary" v-else>
            </div>
        </form>
        <div id="exito" v-else-if="success === true">
            <img src="../assets/icons/success.svg" alt="Tick de éxito">
            <h2>¡Listo!</h2>
            <p>El aviso fue publicado con éxito.</p>
            <router-link to="/" class="btn btn-primary">Volver al inicio</router-link>
        </div>
    </div>
</template>
<script>
import alertasServicio from '../servicios/alertasServicio'
import authServicio from '../servicios/authServicio';

export default {
    name: "PublicarPerdida",
    methods: {
        actualizarDireccion: function(){
            this.direccion = document.getElementById('autocomplete').value;
            
            this.geocoder.geocode({address: document.getElementById('autocomplete').value})
            .then(res => {
                this.latitud = res.results[0].geometry.location.lat();
                this.longitud = res.results[0].geometry.location.lng();

                this.direccionExitosa = true;
            })
            
        },
        crear: function (){

            const data = {
                nombre: this.nombre,
                descripcion: this.descripcion,
                imagenes: this.imagenPerdida, /*****/
                latitud: this.latitud,
                longitud: this.longitud,
                id_usuario: this.usuario.id_usuario,
                id_especie: this.selectedEspecie,
                id_raza: this.selectedRaza,
                id_sexo: this.selectedSexo,
                id_tipoalerta: 2
            }

            alertasServicio.nueva(data).then(res => {
                if(res){
                    this.success = true
                }
            });
        },
        cargarImg: function (){
            const imagen = this.$refs.imagen.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                this.imagenPerdida = reader.result;
            })

            reader.readAsDataURL(imagen);
        },
    },
    mounted() {
        this.usuario = authServicio.getUsuario();
    },
    updated(){
        if(this.paso === 1){
            new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'),
                {
                    bounds: new google.maps.LatLngBounds(
                        new google.maps.LatLng(-35.0233134, -59.5390479)
                    )
                }
            );
            this.geocoder = new google.maps.Geocoder();
        }
    },
    computed:{
        isValid() {
            switch (this.paso){
                case 0: 
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
                    return true
                case 1:
                    if(!this.direccion){
                        return false;
                    }
                    return true
                case 2:
                    if(!this.fecha){
                        return false;
                    }
                    if(!this.hora){
                        return false;
                    }
                    return true
                case 3:
                    if(!this.imagenPerdida){
                        return false;
                    }
                    if(!this.descripcion){
                        return false;
                    }
                    return true
            }
            return true
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
    data: () => {
        return{
            geocoder: null,
            direccionExitosa: null,

            usuario: {},

            success: null,
            paso: 0,
            pasos: [
                {
                    id: 1,
                    titulo: 'Información de la mascota'
                },
                {
                    id: 2,
                    titulo: '¿Dónde se perdió?'
                },
                {
                    id: 3,
                    titulo: 'Fecha y hora'
                },
                {
                    id: 4,
                    titulo: 'Fotos y detalles'
                },
                {
                    id: 5,
                    titulo: 'Confirmá los datos'
                },
            ],
            razas:[
                {
                    id_raza: 1,
                    raza: 'Labrador Retriever'
                },
                {
                    id_raza: 2,
                    raza: 'Border Collie'
                },
                {
                    id_raza: 3,
                    raza: 'Bichón Maltés'
                },
                {
                    id_raza: 4,
                    raza: 'Pitbull'
                },
                {
                    id_raza: 5,
                    raza: 'Pastor Alemán'
                },
                {
                    id_raza: 6,
                    raza: 'Yorkshire Terrier'
                },
            ],

            selectedEspecie: 1,
            selectedRaza: null,
            selectedSexo: null,
            nombre: '',

            direccion: '',
            extraDireccion: '',

            fecha: '',
            hora: '',

            imagenPerdida: null,
            descripcion: '',

            latitud: null,
            longitud: null,
        }
    }
}
</script>
<style scoped>
.form-nueva-header{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    position: relative;
    background: #fff;
    padding: 1rem;
    margin: -1rem;
    margin-bottom: 1rem;
    box-shadow: 0px 2px 16px -10px rgba(119, 119, 119, 0.5);
}

.form-nueva-header > span{
    display: block;
    width: 16px;
    height: 16px;
    text-indent: -500px;
    overflow: hidden;
    position: relative;
    margin-right: 1rem;
}

.form-nueva-header > span::after{
    position: absolute;
    left: 0;
    content: "";
    width: 100%;
    height: 100%;
    background: url("../assets/icons/arrow.svg") center no-repeat;
    background-size: contain;
}

.form-nueva-header .form-nueva-title h1{
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 24px;
}

.form-nueva-header .form-nueva-title p{
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #656565;
}

.form-nueva-header > div:last-of-type{
    position: absolute;
    right: 1rem;

}

.form-nueva-header > div:last-of-type p{
    font-size: 15px;
}

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
}

.sexo-container > div{
    width: 48%;
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

#form-controls{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

#perdida-paso-3::before{
    content: "Si no sabés o no recordás, intentá colocar un aproximado.";
    display: block;
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #656565;
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

#perdida-paso-5 > p{
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #656565;
    margin-top: .5rem;
}

#perdida-paso-5 > article .top,
#perdida-paso-5 > article .bottom{
    padding: 1rem;
}

#perdida-paso-5 > article{
    background: #FFFFFF;
    box-shadow: 0px 24px 24px -24px rgba(37, 37, 37, 0.15);
    border-radius: 8px;
    margin-top: 1rem;
}

#perdida-paso-5 > article .bottom{
    border-top: solid 1px #cecece;
}

#perdida-paso-5 > article .top{
    display: flex;
    justify-content: space-between;
}

#perdida-paso-5 > article .top ul > li{
    font-size: 14px;
    color: #656565;   
    line-height: 24px;
    letter-spacing: 0.01em;
}

#perdida-paso-5 > article .top ul > li:first-of-type{
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.01em;
    color: #252525;
}

#perdida-paso-5 > article .top ul > li:last-of-type{
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

#perdida-paso-5 > article .top ul > li:last-of-type span{
    font-size: 16px;
    line-height: 24px;
    letter-spacing: 0.01em;
    font-weight: 600;
    color: #222222;
}

#perdida-paso-5 > article .bottom ul li:first-of-type{
    display: flex;
    justify-content: space-between;
    margin-bottom: .5rem;
}

#perdida-paso-5 > article .bottom ul li{
    color: #222;
}

#exito{
    text-align: center;
    margin-top: 3rem;
}

#exito img{
    width: 120px;
    height: 120px;
    border: solid 3px #3EEA10;
    display: inline-block;
    padding: 1rem;
    border-radius: 50%;     
}

#exito p{
    margin-bottom: 1rem;
}

</style>