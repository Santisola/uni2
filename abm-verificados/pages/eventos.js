import Layout from "../layouts/layout";
import Image from "next/image";
import Styles from '../styles/Eventos.module.css';

export default function Eventos({datos}) {
    return (
        <Layout
            pagina={"Eventos"}
            title={"Página de eventos"}
            datosUsuario={datos}
        >
         <h1 className={"text-xl font-semibold text-center my-10"}>No tienes ningún evento creado</h1>
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

export async function getServerSideProps() {
    const id = 1;
    const URL = `${process.env.API_URL}/verificado/${id}/infoUsuario`;
    const respuesta = await fetch(URL);
    const resultado = await respuesta.json();
    console.log(resultado);

    return {
        props: {
            datos: resultado.data
        }
    }
}