import Layout from "../layouts/layout";
import {useRouter} from "next/router";
import {useEffect, useState} from "react";

export default function Faq() {
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
            pagina={"FAQ"}
            title={"Preguntas frecuentes"}
            datosUsuario={usuario}
        >
            <h2>Preguntas frecuentes</h2>
        </Layout>
    )
}