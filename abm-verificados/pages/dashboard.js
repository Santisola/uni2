import Link from "next/link";
import Styles from "../styles/Home.module.css";
import Image from "next/image";
import Layout from "../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";

export default function Dashboard({datos}) {
    const [usuario,setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido'
    });

    const router = useRouter();

    useEffect(() => {
        if (datos.length > 0) {
            const {nombre, apellido} = datos[0];
            setUsuario({
                nombre: nombre,
                apellido: apellido
            });
            sessionStorage.setItem('datos',JSON.stringify(datos));
        } else {
            router.push('/login');
        }
    },[datos, router]);

    return (
        <Layout
            pagina={"inicio"}
            title={"Página de inicio"}
            datosUsuario={datos}
        >
            <h1 className={"text-lg font-semibold"}>Bienvenido {usuario.nombre} {usuario.apellido}</h1>
            <p className={"mt-5"}>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam delectus facilis sapiente soluta.</p>
            <Link href={"/eventos"}>
                <div className={Styles.card}>
                    <Image layout={"fixed"} width={126} height={126} src={"/imgs/card-evento.svg"} alt={"Ver eventos"} />
                    <h2 className={"text-xl font-semibold"}>Eventos</h2>
                </div>
            </Link>
        </Layout>
    )
}

export async function getServerSideProps() {
    const id = 2;
    const URL = `${process.env.API_URL}/verificado/${id}/infoUsuario`;
    const respuesta = await fetch(URL);
    const resultado = await respuesta.json();

    return {
        props: {
            datos: resultado.data
        }
    }
}