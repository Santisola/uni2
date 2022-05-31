import Layout from "../layouts/layout";
import Image from "next/image";
import Styles from '../styles/Eventos.module.css';
import {useRouter} from "next/router";
import {useEffect, useState} from "react";

export default function Eventos() {
    const [usuario, setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
    })
    const router = useRouter();

    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
        }
    },[router]);

    return (
        <Layout
            pagina={"Eventos"}
            title={"Página de eventos"}
            datosUsuario={usuario}
        >
         <h2 className={"text-xl font-semibold text-center my-10"}>No tienes ningún evento creado</h2>
            <div className={"flex justify-center items-center my-5"}>
                <Image
                    layout={"fixed"}
                    width={250}
                    height={250}
                    src={'/imgs/no-event.svg'}
                    alt={"Crear un evento"}
                />
            </div>
            <button
                type={"button"}
                className={`${Styles.btn} text-lg mb-10 mt-5`}
            >Crear un evento</button>
        </Layout>
    )
}