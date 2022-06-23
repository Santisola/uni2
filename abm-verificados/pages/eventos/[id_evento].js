import Layout from "../../layouts/layout";
import {useRouter} from "next/router";
import {useEffect, useState} from "react";
import Detalle from "../../eventos/Detalle";
import FormEvento from "../../formularios/FormEvento";
import PawLoader from "../../components/PawLoader";
import UsuarioEliminado from "../../components/UsuarioEliminado";

export default function Id_evento({evento}) {
    const [usuario, setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
    });
    const [eliminado, setEliminado] = useState(null);
    const [editar, setEditar] = useState(false);
    const [success, setSuccess] = useState(false);
    const [loader, setLoader] = useState(false);

    const router = useRouter();


    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
            setEliminado(JSON.parse(sessionStorage.getItem('eliminado')));
        }
    },[router]);
    
    useEffect(() => {
        if (success) {
            router.push('/eventos');
        }
    },[router, success])

    const { id_evento, nombre, descripcion, direccion, latitud, longitud, desde, hasta, imagen, publicado, id_verificado, created_at, updated_at } = evento;

    return (
        <Layout
            pagina={"Detalle del evento"}
            title={nombre}
            datosUsuario={usuario}
        >
            { eliminado !== null && (
                <UsuarioEliminado />
            ) }
            { loader && (
                <PawLoader />
            ) }
            { editar ? (
                <FormEvento
                    setSuccess={setSuccess}
                    setLoader={setLoader}
                    nombreEdit={nombre}
                    descripcionEdit={descripcion}
                    direccionEdit={direccion}
                    desdeEdit={desde}
                    hastaEdit={hasta}
                    imagenEdit={imagen}
                    publicadoEdit={publicado}
                    latitudEdit={latitud}
                    longitudEdit={longitud}
                    editando={editar}
                    id_evento={id_evento}
                />
            ) : (
                    <Detalle
                        nombre={nombre}
                        descripcion={descripcion}
                        direccion={direccion}
                        desde={desde}
                        hasta={hasta}
                        imagen={imagen}
                        publicado={publicado}
                        created_at={created_at}
                        updated_at={updated_at}
                        setEditar={setEditar}
                    />
                )
            }
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