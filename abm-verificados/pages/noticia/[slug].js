import Layout from "../../layouts/layout";
import {useEffect, useState} from "react";
import {useRouter} from "next/router";
import {fecha} from "../../helpers";
import Styles from '../../styles/Noticia.module.css'
import Breadcrum from "../../components/Breadcrum";

export default function EntradaNoticia({noticia}) {
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

    const { contenido, created_at, imagen, titulo } = noticia;

    return(
        <Layout
            pagina={"Detalle de la Noticia"}
            title={titulo}
            datosUsuario={usuario}
        >
            <Breadcrum
                link={'/noticias'}
                anterior={'Noticias'}
                actual={titulo}
            />
            <div>
                <picture>
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img
                        src={imagen}
                        alt={`${titulo} - noticia`}
                    />
                </picture>
            </div>
            <h2 className={"text-xl font-semibold mt-5"}>{titulo}</h2>
            <small className={"block mt-3 mb-5 text-gray-400 text-sm"}>Publicado {fecha(created_at)}</small>
            <p className={Styles.contenido}>{contenido}</p>
        </Layout>
    )
}

export async function getServerSideProps({query: {slug}}) {
    const URL = `${process.env.API_URL}/noticias/${slug}`;
    const respuesta = await fetch(URL);
    const resultado = await respuesta.json();
    const noticia = await resultado.noticia;

    return {
        props: {
            noticia: noticia
        }
    }
}