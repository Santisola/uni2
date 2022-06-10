import Layout from "../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import Link from "next/link";

export default function Configuracion() {
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
            pagina={"configuración"}
            title={"Página de configuración"}
            datosUsuario={usuario}
        >
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aut culpa cupiditate, dignissimos dolorem fugiat incidunt minima nemo nesciunt numquam quisquam, quo repellat temporibus veniam voluptatum!</p>
            <ul className={"mt-5"}>
                <li>
                    <Link href={"/contacto"}><a>Contacto</a></Link>
                </li>
                <li>
                    <Link href={"/editar-perfil"}><a>Editar Perfil</a></Link>
                </li>
                <li>
                    <Link href={"/editar-perfil"}><a>Calendario</a></Link>
                </li>
            </ul>
        </Layout>
    )
}