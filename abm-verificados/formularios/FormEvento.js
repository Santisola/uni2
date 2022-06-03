import React, {useEffect, useState} from "react";
import PawLoader from "../components/PawLoader";
import Styles from '../styles/FormEvento.module.css';
import GoogleMaps from "../google/GoogleMaps";

export default function FormEvento() {
    const [nombre, setNombre] = useState('');
    const [descripcion, setDescripcion] = useState('');
    const [latitud, setLatitud] = useState(0);
    const [longitud, setLongitud] = useState(0);
    const [desde, setDesde] = useState('');
    const [hasta, setHasta] = useState('');
    const [imagen, setImagen] = useState(null);
    const [publicado, setPublicado] = useState(false);
    const [currentUser, setCurrentUser] = useState('');

    const [loader, setLoader] = useState(false);

    const inputFileRef = React.useRef();

    const handleSubmit = e => {
        e.preventDefault();
        console.log('Submited')
    }

    const imageClick = () => {
        inputFileRef.current.click();
    }

    useEffect(() => {
        setCurrentUser(JSON.parse(sessionStorage.getItem('usuario')))
    },[]);

    return(
        <>
            { loader && (
                <PawLoader />
            )}
            <form
                onSubmit={handleSubmit}
                className={Styles.form}
            >
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
                </div>
                {/*Google Maps*/}
                <div className={`my-5 ${Styles.googleContainer}`}>
                    <GoogleMaps
                        setLatitud={setLatitud}
                        setLongitud={setLongitud}
                        latitud={latitud}
                        longitud={longitud}
                    />
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
                    />
                    <button
                        onClick={imageClick}
                        className={Styles.imagen}
                    >Agregar Imagen</button>
                    <small>La imagen del evento es opcional</small>
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
                    >Guardar</button>
                    <button
                        type={"submit"}
                        value={publicado}
                        onClick={() => setPublicado(true)}
                    >Publicar</button>
                </div>
            </form>
        </>
    )
}