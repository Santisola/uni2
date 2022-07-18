import React, {useState} from "react";
import Styles from "../styles/FormCompletar.module.css";
import PawLoader from "../components/PawLoader";
import Mensaje from "../components/Mensaje";
import {useRouter} from "next/router";
import {previewImage} from "../helpers";

export default function FormCompletar() {
    const [telefono,setTelefono] = useState('');
    const [imagen, setImagen] = useState('');
    const [error, setError] = useState(false);
    const [mensajeError, setMensajeError] = useState('');
    const [errorTelefono, setErrorTelefono] = useState('');
    const [errorImagen, setErrorImagen] = useState('');
    const [disabled, setDisabled] = useState(false);
    const [loader, setLoader] = useState(false);

    const router = useRouter();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoader(true);
        setDisabled(true);

        const data = {
            telefono: Number(telefono),
            imagen: imagen,
        }

        if (validateData(data)) {
            setMensajeError('Error al completar los campos');
            setError(true);
            setLoader(false);
            setDisabled(false);

            setTimeout(() => {
                setError(false);
            },10000);
            return;
        }

        const formData = new FormData();

        formData.append('imagen', imagen);
        formData.append('telefono', telefono);
        formData.append('_method', 'PUT');

        try {
            const id = await JSON.parse(sessionStorage.getItem('id'))
            const url = `${process.env.API_URL}/verificado/${id}/complete`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData,
            });
            const resultado = await respuesta.json();
            if (resultado[0].original.success === true) {
                // return console.log(resultado[0].original.data[0]);
                const { cuit, email, imagen, razon_social, telefono } = resultado[0].original.data[0];
                const id_verificado = resultado[0].original.id;

                const usuario = {
                    cuit: cuit,
                    email: email,
                    imagen: imagen,
                    razon_social: razon_social,
                    telefono: telefono,
                }

                await sessionStorage.setItem('usuario',JSON.stringify(usuario));
                await sessionStorage.setItem('id',JSON.stringify(id_verificado));

                await router.push('/');

            } else {
                setError(true);
                setMensajeError('Hubo un error al llenar los campos');
                resultado[0].original.data[0] ? setErrorImagen(resultado.data.imagen) : '';
                resultado[0].original.data[0] ? setErrorTelefono(resultado.data.telefono) : '';

                setTimeout(() => {
                    setError(false);
                },10000);
            }
        }
        catch (e) {
            console.error(e);
        }

        setDisabled(false);
        setLoader(false);
    }

    function validateData(datos) {
        setErrorTelefono('');
        setErrorImagen('');

        const { telefono, imagen } = datos;

        let errores  = {};

        if (isNaN(telefono)) {
            errores.telefono = 'El número de teléfono debe contener solamente números';
        }

        if (telefono === 0) {
            errores.telefono = 'El campo teléfono está vacío';
        }

        if (imagen === '') {
            errores.imagen = 'El campo imagen está vacío';
        }

        if (Object.keys(errores).length > 0) {

            if (errores.telefono) {
                setErrorTelefono(errores.telefono);
            }

            if (errores.imagen) {
                setErrorImagen(errores.imagen);
            }
            return true;
        } else {
            return false;
        }
    }
    
    return (
        <div
            className={Styles.formularioModal}
        >
            { loader && (
                <PawLoader />
            )}
            <form
                className={`${Styles.form} flex flex-col items-center justify-center`}
                onSubmit={e => handleSubmit(e)}
            >
                <p className={"text-center text-md mb-5 font-semibold"}>Estos datos serán visibles en la aplicación de <b className={"text-violeta"}>Unidos</b></p>
                { error && (
                    <Mensaje
                        tipo={false}
                        mensaje={mensajeError}
                    />
                )}
                <div className={Styles.inpiutContainer}>
                    <label
                        className={"text-lg"}
                        htmlFor={"telefono"}>Teléfono</label>
                    <input
                        type={"tel"}
                        name={"telefono"}
                        id={"telefono"}
                        value={telefono}
                        onChange={e => setTelefono(e.target.value)}
                        placeholder={"Ingrese su número de teléfono aquí"}
                        disabled={disabled}
                    />
                    { errorTelefono !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorTelefono}</p>
                        </div>
                    )}
                </div>
                <div className={Styles.inpiutContainer}>
                    <label
                        className={"text-lg"}
                        htmlFor={"imagen"}>Imagen</label>
                    <input
                        type={"file"}
                        name={"imagen"}
                        id={"imagen"}
                        className={"file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"}
                        onChange={e => setImagen(e.target.files[0])}
                    />
                    { typeof imagen === "object" && (
                        // eslint-disable-next-line @next/next/no-img-element
                        <img
                            className={Styles.preview}
                            src={previewImage(imagen)}
                            alt="imagen" />
                    ) }
                    { errorImagen !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorImagen}</p>
                        </div>
                    )}
                </div>
                <div className={Styles.inpiutContainer}>
                    <input
                        type={"submit"}
                        value={"Guardar datos"}
                        className={"mt-20 block py-2"}
                    />
                </div>
            </form>
        </div>
    )
}