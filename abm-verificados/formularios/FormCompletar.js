import {useState} from "react";
import Styles from "../styles/LoginForm.module.css";
import PawLoader from "../components/PawLoader";
import Mensaje from "../components/Mensaje";
import {useRouter} from "next/router";

export default function FormCompletar() {
    const [telefono,setTelefono] = useState('');
    const [imagen,setImagen] = useState('');
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
            const id = JSON.parse(sessionStorage.getItem('id'))
            const url = `${process.env.API_URL}/verificado/${id}/complete`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData,
            });
            const resultado = await respuesta.json();

            if (resultado.success === true) {
                const { data: { cuit, email, id_verificado, imagen, razon_social, telefono } } = resultado;

                const usuario = {
                    cuit: cuit,
                    email: email,
                    imagen: imagen,
                    razon_social: razon_social,
                    telefono: telefono,
                }

                sessionStorage.setItem('usuario',JSON.stringify(usuario));
                sessionStorage.setItem('id',JSON.stringify(id_verificado));

                await router.push('/');

            } else {
                setError(true);
                setMensajeError('Hubo un error al llenar los campos');
                resultado.data.imagen ? setErrorImagen(resultado.data.imagen) : '';
                resultado.data.telefono ? setErrorTelefono(resultado.data.telefono) : '';

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
                <p className={"text-center text-md mb-5 font-bold"}>Complete los siguientes datos para dar de alta su usuario</p>
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
                        onChange={e => setImagen(e.target.files[0])}
                    />
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
                        className={"mt-20 block"}
                    />
                </div>
            </form>
        </div>
    )
}