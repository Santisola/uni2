import Layout from "../layouts/layout";
import { useEffect, useState } from "react";
import { useRouter } from "next/router";
import FormEditarPerfil from "../formularios/FormEditarPerfil";
import UsuarioEliminado from "../components/UsuarioEliminado";

export default function EditarPerfil() {
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
            pagina={"Editar Perfil"}
            title={"Página editar perfil"}
            datosUsuario={usuario}
        >
            { eliminado !== null && (
                <UsuarioEliminado />
            ) }
            <p className={"text-center mt-5 mb-10 font-semibold"}>Complete únicamente los datos que quiera cambiar</p>
            <FormEditarPerfil
                usuario={usuario}
            />
        </Layout>
    );
}