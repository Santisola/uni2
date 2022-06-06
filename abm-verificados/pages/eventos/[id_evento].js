import Layout from "../../layouts/layout";
import {useRouter} from "next/router";
import {useEffect, useState} from "react";
import Detalle from "../../eventos/Detalle";

export default function Id_evento({evento}) {
    const [usuario, setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
    });
    const router = useRouter();

    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
        }
    },[router]);

    const { id_evento, nombre, descripcion, latitud, longitud, desde, hasta, imagen, publicado, id_verificado, created_at, updated_at } = evento;

    return (
        <Layout
            pagina={"Detalle del evento"}
            title={nombre}
            datosUsuario={usuario}
        >
            <Detalle
                nombre={nombre}
                descripcion={descripcion}
                desde={desde}
                hasta={hasta}
                imagen={imagen}
                publicado={publicado}
                created_at={created_at}
                updated_at={updated_at}
            />
        </Layout>
    )
}

export async function getServerSideProps({query: {id_evento}}) {
    const URL = `${process.env.API_URL}/evento-cms/${id_evento}`;
    const respuesta = await fetch(URL);
    const resultado = await respuesta.json();
    const evento = await resultado.evento;

    return {
        props: {
            evento: evento
        }
    }
}