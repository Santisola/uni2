import Layout from "../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import Link from "next/link";
import UsuarioEliminado from "../components/UsuarioEliminado";

export default function Configuracion() {
    const [usuario,setUsuario] = useState({
        razon_social: 'Nombre Apellido',
    });
    const [eliminado, setEliminado] = useState(null);

    const router = useRouter();

    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            return router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
            setEliminado(JSON.parse(sessionStorage.getItem('eliminado')));
        }
    },[router]);

    return (
        <Layout
            pagina={"configuración"}
            title={"Página de configuración"}
            datosUsuario={usuario}
        >
            { eliminado !== null && (
                <UsuarioEliminado />
            ) }
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aut culpa cupiditate, dignissimos dolorem fugiat incidunt minima nemo nesciunt numquam quisquam, quo repellat temporibus veniam voluptatum!</p>
            <ul className={"mt-5"}>
                <li>
                    <Link href={"/contacto"}><a className={"bg-amarillo w-fit rounded px-3 py-2"}>Contacto</a></Link>
                </li>
                {/*<li className={"bg-amarillo w-fit rounded px-3 py-1"}>
                    <Link href={"/editar-perfil"}><a>Editar Perfil</a></Link>
                </li>*/}
            </ul>
        </Layout>
    )
}