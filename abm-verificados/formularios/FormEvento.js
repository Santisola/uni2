import React, { useEffect, useState } from "react";
import Styles from '../styles/FormEvento.module.css';
import GoogleMaps from "../google/GoogleMaps";

export default function FormEvento({
    setSuccess,
    setLoader,
    nombreEdit,
    descripcionEdit,
    desdeEdit,
    hastaEdit,
    imagenEdit,
    publicadoEdit,
    latitudEdit,
    longitudEdit,
    editando,
    id_evento
}) {
    const [nombre, setNombre] = useState(nombreEdit ? nombreEdit : '');
    const [descripcion, setDescripcion] = useState(descripcionEdit ? descripcionEdit : '');
    const [latitud, setLatitud] = useState(latitudEdit ? latitudEdit : 0);
    const [longitud, setLongitud] = useState(longitudEdit ? longitudEdit : 0);
    const [desde, setDesde] = useState(desdeEdit ? desdeEdit : '');
    const [hasta, setHasta] = useState(hastaEdit ? hastaEdit : '');
    const [imagen, setImagen] = useState(imagenEdit ? imagenEdit : null);
    const [publicado, setPublicado] = useState(publicadoEdit ? publicadoEdit : false);
    const [currentUser, setCurrentUser] = useState('');

    // Errores
    const [errorNombre, setErrorNombre] = useState('');
    const [errorDescripcion, setErrorDescripcion] = useState('');
    const [errorFecha, setErrorFecha] = useState('');
    const [errorImagen, setErrorImagen] = useState('');
    const [errorPublicado, setErrorPublicado] = useState('');
    const [errorLugar, setErrorLugar] = useState('');

    const [errorMensaje, setErrorMensaje] = useState('');

    const inputFileRef = React.useRef();

    const handleSubmit = async e => {
        e.preventDefault();
        setLoader(true);

        // Validar
        const evento = {
            nombre,
            descripcion,
            latitud,
            longitud,
            desde,
            hasta,
            imagen,
            publicado,
            currentUser
        }

        if (validateEvento(evento)) {
            // console.log('Validó evento')
            return setLoader(false);
        }

        // Enviar al backend
        const formData = new FormData();
        formData.append('nombre',nombre);
        formData.append('descripcion',descripcion);
        formData.append('latitud',latitud);
        formData.append('longitud',longitud);
        formData.append('desde',desde);
        formData.append('hasta',hasta);
        formData.append('imagen',imagen);
        formData.append('publicado',publicado);
        formData.append('id_verificado',currentUser);

        try {
            let url;
            if (editando) {
                url = `${process.env.API_URL}/evento-cms/${id_evento}/editar`;
                formData.append('_method','PUT');
            } else {
                url = `${process.env.API_URL}/nuevo-evento`;
            }

            console.log(url);

            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData
            });
            const resultado = await respuesta.json();

            console.log(resultado)

            if (resultado.success === false) {
                const {mensaje} = resultado;
                if (typeof mensaje !== "object") {
                    setErrorMensaje(mensaje);
                } else {
                    mensaje.desde ? setErrorFecha(mensaje.desde) : null;
                    mensaje.hasta ? setErrorFecha(mensaje.hasta) : null;
                }
            } else {
                setSuccess(true);
            }

        } catch (e) {
            console.error(e);
        }

        // Final
        setLoader(false);
    }

    const imageClick = () => {
        inputFileRef.current.click();
    }

    function resetErrors() {
        setErrorImagen('');
        setErrorPublicado('');
        setErrorNombre('');
        setErrorFecha('');
        setErrorDescripcion('');
    }

    const validateEvento = data => {
        const { nombre, descripcion, desde, hasta, imagen, latitud, longitud, publicado } = data;
        resetErrors();

        let errores = {};

        if (nombre.trim() === '') {
            errores.nombre = "El campo nombre no puede estar vacío";
        }

        if (nombre.trim().length < 3) {
            errores.nombre = "El nombre del evento debe tener al menos 3 caracteres";
        }

        if (descripcion.trim() === '') {
            errores.descripcion = "El campo descripción no puede estar vacío";
        }

        if (descripcion.trim().length < 30) {
            errores.descripcion = "La descripción debe tener al menos 30 caracteres";
        }

        if (desde === '' || hasta === '') {
            errores.fechas = "Las fechas están vacías"
        }

        if (Date.parse(desde) > Date.parse(hasta)) {
            errores.fechas = "La fecha de inicio del evento no puede ser mayor a la fecha de finalización del evento";
        }

        if (Date.parse(desde) === Date.parse(hasta)) {
            errores.fechas = "Las fechas no pueden ser exactamente las mismas";
        }

        if (imagen === null) {
            errores.imagen = "Selecciona un imagen";
        }

        if ((/\.(jpe?g|png)$/i).test(imagen)) {
            errores.imagen = "El formato del archivo no es válido, únicamente .jpg, .jpeg y .png";
        }

        if (typeof publicado !== "boolean") {
            errores.publicado = "Error al momento de publicar o guardar el evento";
        }

        if (latitud === '' || longitud === '' || isNaN(latitud) || isNaN(longitud)) {
            errores.lugar = "Tiene que seleccionar un lugar donde se realizará el evento";
        }

        if (Object.keys(errores).length > 0) {
            if (errores.nombre) {
                setErrorNombre(errores.nombre);
            }

            if (errores.descripcion) {
                setErrorDescripcion(errores.descripcion);
            }

            if (errores.fechas) {
                setErrorFecha(errores.fechas);
            }

            if (errores.imagen) {
                setErrorImagen(errores.imagen);
            }

            if (errores.publicado) {
                setErrorPublicado(errores.publicado);
            }

            if (errores.lugar) {
                setErrorLugar(errores.lugar);
            }

            return true;
        } else {
            return false;
        }
    }

    useEffect(() => {
        setCurrentUser(JSON.parse(sessionStorage.getItem('id')))
    },[]);

    return(
        <>
            <form
                onSubmit={handleSubmit}
                className={Styles.form}
            >
                { errorMensaje !== '' && (
                    <p
                        className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                        role={"alert"}
                    >{errorMensaje}</p>
                ) }
                <p className={"my-5"}>Complete los siguientes campos para crear su evento</p>
                <div
                    className={`${Styles.formGroups} w-full`}
                >
                    <label
                        htmlFor="nombre"
                    >Nombre del evento</label>
                    <input
                        type={"text"}
                        name={"nombre"}
                        id={"nombre"}
                        value={nombre}
                        onChange={e => setNombre(e.target.value)}
                        placeholder={"Ingrese aquí el nombre del evento"}
                    />
                    { errorNombre !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorNombre}</p>
                    )}
                </div>
                <div
                    className={`${Styles.formGroups} w-full`}
                >
                    <label
                        htmlFor="descripcion"
                    >Descripción del evento</label>
                    <textarea
                        name={"descripcion"}
                        id={"descripcion"}
                        onChange={e => setDescripcion(e.target.value)}
                        placeholder={"Ingrese aquí el contenido que tendrá su evento"}
                        value={descripcion}
                     />
                    <small>El contenido no puede ser menor a 30 caracteres</small>
                    { errorDescripcion !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorDescripcion}</p>
                    )}
                </div>
                <div
                    className={`${Styles.formGroups} w-full md:w-1/2`}
                >
                    <label
                        htmlFor={"desde"}
                    >Desde</label>
                    <input
                        type={"datetime-local"}
                        name={"desde"}
                        id={"desde"}
                        onChange={e => setDesde(e.target.value)}
                        value={desde}
                    />
                </div>
                <div
                    className={`${Styles.formGroups} w-full md:w-1/2`}
                >
                    <label
                        htmlFor={"hasta"}
                    >Hasta</label>
                    <input
                        type={"datetime-local"}
                        name={"hasta"}
                        id={"hasta"}
                        onChange={e => setHasta(e.target.value)}
                        value={hasta}
                    />
                    { errorFecha !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorFecha}</p>
                    )}
                </div>
                {/*Google Maps*/}
                <div className={`my-5 ${Styles.googleContainer}`}>
                    <GoogleMaps
                        setLatitud={setLatitud}
                        setLongitud={setLongitud}
                        latitud={latitud}
                        longitud={longitud}
                    />
                    { errorLugar !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorLugar}</p>
                    ) }
                </div>
                <div
                    className={`${Styles.formGroups} w-full`}
                >
                    <label
                        htmlFor={"imagen"}
                    >Imagen</label>
                    <input
                        style={{ display: "none" }}
                        type={"file"}
                        name={"imagen"}
                        id={"imagen"}
                        onChange={e => setImagen(e.target.files[0])}
                        ref={inputFileRef}
                        accept={"image/*"}
                    />
                    <button
                        onClick={imageClick}
                        className={Styles.imagen}
                        type={"button"}
                    >Agregar Imagen</button>
                    <small>La imagen del evento es opcional</small>
                    { errorImagen !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorImagen}</p>
                    ) }
                </div>
                <input
                    type={"hidden"}
                    value={currentUser}
                />
                <div
                    className={Styles.botones}
                >
                    <button
                        type={"submit"}
                        value={publicado}
                        onClick={() => setPublicado(false)}
                    >Guardar Borrador</button>
                    <button
                        type={"submit"}
                        value={publicado}
                        onClick={() => setPublicado(true)}
                    >Publicar</button>
                    { errorPublicado !== '' && (
                        <p
                            className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"}
                            role={"alert"}
                        >{errorPublicado}</p>
                    ) }
                </div>
            </form>
        </>
    )
}