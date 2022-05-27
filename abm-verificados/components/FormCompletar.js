import {useState} from "react";
import {validateEmail} from "../helpers";

export default function FormCompletar() {
    const [telefono,settelefono] = useState('');
    const [imagen,setImagen] = useState('');
    const [error, setError] = useState(false);
    const [mensajeError, setMensajeError] = useState('');
    const [errorTelefono, setErrorTelefono] = useState('');
    const [errorImagen, setErrorImagen] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoader(true);

        const data = {
            telefono: Number(telefono),
            imagen,
        }

        if (validateData(data)) {
            setMensajeError('Error al completar los campos');
            setError(true);
            setLoader(false);

            setTimeout(() => {
                setError(false);
            },10000);
            return;
        }

        try {
            const url = `${process.env.API_URL}/verificado/{usuario}/complete`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json"
                }
            });
            const resultado = await respuesta.json();
            console.log(resultado);
            setLoader(false);

            if (resultado.success === false) {
                setError(true);
                // setMensajeError(resultado.mensaje);

                setTimeout(() => {
                    setError(false);
                },10000);
            }


        }
        catch (e) {
            console.error(e);
        }
    }

    function validateData(datos) {
        setErrorTelefono('');
        setErrorImagen('');

        const { telefono, imagen } = datos;
        let errores  = {};

        if (isNaN(telefono)) {
            errores.telefono = 'El número de teléfono debe contener solamente números';
        }

        if (telefono === '') {
            errores.telefono = 'El campo teléfono está vacío';
        }

        if (imagen === '') {
            errores.imagen = 'El campo imagen está vacío';
        }

        if (Object.keys(errores).length > 0) {

            if (errores.telefono) {
                setErrorTelefono(errores.cuit);
            }

            if (errores.imagen) {
                setErrorImagen(errores.imagen);
            }
            return true;
        } else {
            return false;
        }
    }
}