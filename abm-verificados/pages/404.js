import Layout from "../layouts/layout";
import Link from "next/link";
import Styles from '../styles/404.module.css'
import Image from "next/image";
import { getSessionStorage } from "../helpers";
import { useEffect, useState } from "react";

export default function Error404() {
    const [datos, setDatos] = useState('');

    useEffect(() => {
        setDatos(getSessionStorage());
    },[])

    return (
        <Layout
            pagina={"Error"}
            title={"Página no encontrada"}
            datosUsuario={datos}
        >
            <h1 className={"sr-only"}>Página no encontrada</h1>
            <p className={"text-5xl text-center font-semibold"}>¡Ups!</p>
            <Image layout={"responsive"} width={330} height={330} src={"/imgs/404.svg"} alt={"Error"} />
            <p className={"mt-5 text-2xl font-semibold"}>Parece que la sección que busca no existe</p>
            <Link href={"/"}>
                <a className={Styles.error}>Click aquí para volver</a>
            </Link>
        </Layout>
    )
}
