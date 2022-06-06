import Layout from "../layouts/layout";
import Image from "next/image";
import Styles from '../styles/Eventos.module.css';
import {useRouter} from "next/router";
import {useEffect, useState} from "react";
import Link from "next/link";
import CrearPrimerEvento from "../eventos/CrearPrimerEvento";
import Evento from "../eventos/Evento";
import PawLoader from "../components/PawLoader";

export default function Eventos() {
    const [usuario, setUsuario] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
    });
    const [fetching, setFetching] = useState(true);
    const [id, setID] = useState('');
    const [eventos, setEventos] = useState([]);

    const router = useRouter();

    useEffect(() => {
        if (!sessionStorage.getItem('usuario')) {
            router.push('/login');
        } else {
            setUsuario(JSON.parse(sessionStorage.getItem('usuario')));
        }
    },[router]);

    useEffect(() => {
        sessionStorage.getItem('id') ? setID(JSON.parse(sessionStorage.getItem('id'))) : sessionStorage.removeItem('usuario');
    },[]);

    const buscarEventos = async id => {
        const URL = `${process.env.API_URL}/eventos-cms/${Number(id)}`;
        const respuesta = await fetch(URL);
        const resultado = await respuesta.json();

        console.log(respuesta);

        setEventos(resultado['eventos']);
        setFetching(false);
    }

    useEffect(()  => {
        if (id !== '') {
            buscarEventos(id)
        }
    },[id]);

    return (
        <Layout
            pagina={"Eventos"}
            title={"Página de eventos"}
            datosUsuario={usuario}
        >
            { fetching && (
                <PawLoader />
            ) }
            { eventos.length > 0 ? (
                    eventos.map(evento => (
                            <Evento
                                key={evento.id_evento}
                                evento={evento}
                            />
                        )
                    )
            ) : (
                <CrearPrimerEvento />
            ) }
        </Layout>
    )
}