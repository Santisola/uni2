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
            router.push('/login');
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
            <h2 className={"mb-5 text-xl font-semibold"}>¿Desea editar datos de su perfil?</h2>
            <p className={"mb-5"}>Esto lo puede hacer en cualquier momento, tenga en cuenta que una vez editado los datos con su usuario ya validado; esos cambios ya estarán visibles en la aplicación de Unidos. Tenga en cuenta que los datos como CUIT y RAZÓN SOCIAL no se podrán modificar. En ese caso póngase en contacto con nosotros.</p>
            <h2 className={"mb-5 text-xl font-semibold"}>¿Su cuenta ha sido bloqueada?</h2>
            <p>Si ese es el caso póngase en contacto con nosotros para solucionar el inconveniente</p>
            <ul className={"mt-5"}>
                <li>
                    <Link href={"/contacto"}><a className={"bg-amarillo w-fit rounded px-3 py-2"}>Contacto</a></Link>
                </li>
            {/*  Acá iria la opción de editar el perfil  */}
            </ul>
        </Layout>
    )
}