import {useState} from "react";
import {useRouter} from "next/router";
import Mensaje from "../components/Mensaje";
import PawLoader from "../components/PawLoader";
import {validateEmail} from "../helpers";

export default function FormEditarPerfil({ usuario }) {
    const [email, setEmail] = useState(usuario.email);
    const [imagen, setImagen] = useState(usuario.imagen);
    const [telefono, setTelefono] = useState(usuario.telefono);
    const [password, setPassword] = useState('');

    const [error, setError] = useState(false);
    const [mensajeError, setMensajeError] = useState('');
    const [errorTelefono, setErrorTelefono] = useState('');
    const [errorImagen, setErrorImagen] = useState('');
    const [errorEmail, setErrorEmail] = useState('');
    const [errorPassword, setErrorPassword] = useState('');
    const [disabled, setDisabled] = useState(false);
    const [loader, setLoader] = useState(false);

    const router = useRouter();

    const handleSubmit = async e => {
        e.preventDefault();

        const data = {
            telefono: Number(telefono),
            imagen,
            email,
            password
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
        formData.append('email', email);
        formData.append('password', password);
        formData.append('_method', 'PUT');

        try {
            const id = await JSON.parse(sessionStorage.getItem('id'))
            const url = `${process.env.API_URL}/verificado/${id}/update`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData,
            });
            const resultado = await respuesta.json();

            if (resultado[0].original.success === true) {
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

                await router.push('/configuracion');

            } else {
                setError(true);
                setMensajeError('Hubo un error al llenar los campos');

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

        if (telefono === 0) {
            errores.telefono = 'El campo teléfono está vacío';
        }

        if (imagen === '') {
            errores.imagen = 'El campo imagen está vacío';
        }

        if (email === '') {
            errores.email = 'El campo email está vacío'
        }

        if (validateEmail(email)) {
            errores.email = 'El email no es válido';
        }

        if (password === '') {
            errores.password = 'La contraseña está vacía';
        }

        if (Object.keys(errores).length > 0) {

            if (errores.telefono) {
                setErrorTelefono(errores.telefono);
            }

            if (errores.imagen) {
                setErrorImagen(errores.imagen);
            }

            if (errores.email) {
                setErrorEmail(errores.email)
            }

            if (errores.password) {
                setErrorPassword(errores.password);
            }

            return true;
        } else {
            return false;
        }
    }

    return (
        <>
            { loader && (
                <PawLoader />
            )}
            <form
                action="#"
                method={"post"}
                onSubmit={handleSubmit}
            >
                { error && (
                    <Mensaje
                        tipo={false}
                        mensaje={mensajeError}
                    />
                )}
                <div className={"mb-5 flex flex-col"}>
                    <label htmlFor={"email"} className={"mb-1"}>Email</label>
                    <input
                        type={"email"}
                        id={"email"}
                        name={"email"}
                        value={email}
                        onChange={e => setEmail(e.target.value)}
                        className={"border rounded px-3 py-1"}
                        placeholder={"Ingrese su email aquí"}
                        disabled={disabled}
                    />
                    { errorEmail !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorEmail}</p>
                        </div>
                    )}
                </div>
                <div className={"mb-5 flex flex-col"}>
                    <label htmlFor={"telefono"} className={"mb-1"}>Teléfono</label>
                    <input
                        type={"tel"}
                        id={"telefono"}
                        name={"telefono"}
                        value={telefono}
                        onChange={e => setTelefono(e.target.value)}
                        className={"border rounded px-3 py-1"}
                        placeholder={"Ingrese su teléfono aquí"}
                        disabled={disabled}
                    />
                    { errorTelefono !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorTelefono}</p>
                        </div>
                    )}
                </div>
                <div className="mb-5 flex flex-col">
                    <label htmlFor={"imagen"} className={"mb-1"}>Imagen</label>
                    <input
                        type="file"
                        accept={"image/*"}
                        id={"imagen"}
                        name={"imagen"}
                        onChange={e => setImagen(e.target.files[0])}
                        disabled={disabled}
                    />
                    { typeof imagen === "string" && (
                        <div className={"mt-3"}>
                            <span>Preview:</span>
                            {/* eslint-disable-next-line @next/next/no-img-element */}
                            <img src={process.env.API_IMAGEN + imagen} alt="imagen" className={"block w-full"}/>
                        </div>
                    )}
                    { errorImagen !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorImagen}</p>
                        </div>
                    )}
                </div>
                <div className={"mb-5 flex flex-col"}>
                    <label htmlFor={"password"} className={"mb-1"}>Contraseña</label>
                    <input
                        type={"password"}
                        id={"password"}
                        name={"password"}
                        value={password}
                        onChange={e => setPassword(e.target.value)}
                        className={"border rounded px-3 py-1"}
                        placeholder={"Ingrese su contraseña aquí"}
                        disabled={disabled}
                    />
                    { errorPassword !== '' && (
                        <div className={"mt-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"} role={"alert"}>
                            <p className={"text-center"}>{errorPassword}</p>
                        </div>
                    )}
                </div>
                <button
                    type={"submit"}
                    className={"bg-violeta border rounded text-white px-5 py-1 w-full md:w-fit"}
                >Guardar Datos</button>
            </form>
        </>
    )
}