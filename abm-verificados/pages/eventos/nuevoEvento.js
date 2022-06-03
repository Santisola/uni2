import Layout from "../../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import FormEvento from "../../formularios/FormEvento";

export default function NuevoEvento() {
    const [usuario, setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
    })
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
            pagina={"Nuevo Evento"}
            title={"Nuevo evento"}
            datosUsuario={usuario}
        >
            <h2 className={"text-xl font-semibold text-center my-10"}>Cree aquí su evento</h2>
            <div className={"mt-5"}>
                <FormEvento />
            </div>
        </Layout>
    )
}