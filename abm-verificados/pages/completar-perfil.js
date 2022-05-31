import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import Layout from "../layouts/layout";
import Link from "next/link";
import Styles from "../styles/Home.module.css";
import Image from "next/image";
import FormCompletar from "../formularios/FormCompletar";

export default function CompletarPerfil() {
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
            pagina={"Completar Perfil"}
            title={"Completar datos del perfil"}
            datosUsuario={usuario}
        >
            <FormCompletar

            />
        </Layout>
    )
}