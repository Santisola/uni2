import Link from "next/link";
import Styles from "../styles/Home.module.css";
import Image from "next/image";
import Layout from "../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import UsuarioEliminado from "../components/UsuarioEliminado";

export default function Dashboard() {
    const [usuario,setUsuario] = useState({
        razon_social: 'Nombre Apellido',
    });
    const [eliminado, setEliminado] = useState(null);
    const [id, setID] = useState(null);

    const router = useRouter();

    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
            setEliminado(JSON.parse(sessionStorage.getItem('eliminado')));
            setID(JSON.parse(sessionStorage.getItem('id')));
        }
    },[router]);

    return (
        <Layout
            pagina={"inicio"}
            title={"Página de inicio"}
            datosUsuario={usuario}
        >
            { eliminado !== null && (
                <UsuarioEliminado />
            ) }
            <h2 className={"text-lg font-semibold"}>Bienvenido {usuario.razon_social}</h2>
            <div className={"mb-5"}>
                <p className={"mt-5"}>Crea, modifica y supervisa tus eventos personalizados para poder alcanzar a esas personas amantes de los animales.</p>
                <Link href={"/eventos"}>
                    <div className={`${Styles.card} ${Styles.cardVioleta}`}>
                        <Image layout={"fixed"} width={126} height={126} src={"/imgs/card-evento.svg"} alt={"Ver eventos"} />
                        <h2 className={"text-xl font-semibold"}>Eventos</h2>
                    </div>
                </Link>
            </div>
            <hr/>
            <div>
                <p className={"mt-5"}>En la sección de noticias te informamos de todo lo necesario para el uso de esta aplicación y novedades próximas que te podrán servir al momento de crear eventos y cómo llegar esos usuarios</p>
                <Link href={"/noticias"}>
                    <div className={`${Styles.card} ${Styles.cardAmarillo}`}>
                        <Image layout={"fixed"} width={126} height={126} src={"/imgs/card-noticia.svg"} alt={"Ver Noticias"} />
                        <h2 className={"text-xl font-semibold"}>Noticias</h2>
                    </div>
                </Link>
            </div>
        </Layout>
    )
}