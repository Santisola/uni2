import Link from "next/link";
import Styles from "../styles/Home.module.css";
import Image from "next/image";
import Layout from "../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";

export default function Dashboard() {
    const [usuario,setUsuario] = useState({
        razon_social: 'Nombre Apellido',
    });

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
            pagina={"inicio"}
            title={"Página de inicio"}
            datosUsuario={usuario}
        >
            <h2 className={"text-lg font-semibold"}>Bienvenido {usuario.razon_social}</h2>
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