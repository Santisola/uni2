import Layout from "../layouts/layout";
import {useRouter} from "next/router";
import { useEffect, useState } from "react";
import Noticia from "../components/Noticia";

export default function Noticias({noticias}) {
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
            pagina={"Noticias"}
            title={"Página de noticias"}
            datosUsuario={usuario}
        >
            <h2 className={"text-xl font-semibold my-10"}>Estas son las noticias destacadas</h2>
            { noticias.map((noticia, index) => (
                <Noticia
                    key={noticia.id ? noticia.id : index}
                    noticia={noticia}
                />
            ))}
        </Layout>
    )
}

export async function getServerSideProps() {
    const URL = `${process.env.API_URL}/noticias`;
    const respuesta = await fetch(URL);
    const resultado = await respuesta.json();
    // console.log(resultado);

    return {
        props: {
            noticias: resultado.noticias
        }
    }
}