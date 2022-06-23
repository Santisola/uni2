import Layout from "../layouts/layout";
import {useRouter} from "next/router";
import {useEffect, useState} from "react";
import UsuarioEliminado from "../components/UsuarioEliminado";

export default function Faq() {
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
            pagina={"FAQ"}
            title={"Preguntas frecuentes"}
            datosUsuario={usuario}
        >
            { eliminado !== null && (
                <UsuarioEliminado />
            ) }
            <h2>Preguntas frecuentes</h2>
        </Layout>
    )
}