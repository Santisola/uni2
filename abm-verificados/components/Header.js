import Link from "next/link";
import Image from "next/image";
import Styles from '../styles/Header.module.css';
import {useState} from "react";

export default function Header({pagina}) {
    const [abierto, setAbierto] = useState(false);

    return (
        <header className={`${Styles.header} py-10 px-5`}>
            <Link href={"/"}>
                <a className={""}><Image layout={"fixed"} width={100} height={30} src={"/imgs/logo.svg"} alt={"Logo"}  /></a>
            </Link>
            <p className={`${Styles.pagina} text-lg uppercase`}>{pagina}</p>
            <button
                className={`${Styles.button} ${abierto ? Styles.open : ''}`}
                onClick={() => {setAbierto(!abierto)}}
            >
                <span></span>
            </button>
            <div
                className={`${Styles.background} ${ abierto ? Styles.aparecer : ''}`}
                onClick={() => {setAbierto(!abierto)}}
            >
                <nav className={Styles.nav}>
                    <div className={Styles.usuario}>
                        <Image layout={"fixed"} width={50} height={50} src={"/imgs/user-default.png"} alt={"Imagen del usuario"}  />
                        <div>
                            <p className={"text-white text-lg font-semibold"}>Nombre Apellido</p>
                            <p className={"text-white"}>email@correo.com</p>
                        </div>
                    </div>
                    <p className={"mt-5 text-center text-white flex gap-2 mx-auto items-center justify-center"}>Estado
                        <button
                            className={Styles.pregunta}
                        >
                            ?
                        <span className={`animate-ping ${Styles.ping}`}></span>
                        </button>
                    </p>
                    <ul className={"mt-5 px-5"}>
                        <li className={"text-white"}>
                            <Link href={"/"}>
                                <a>
                                    <Image layout={"fixed"} width={30} height={30} src={"/imgs/dashboard-icon.svg"} alt={"icono de notificación"} /> Dashboard
                                </a>
                            </Link>
                        </li>
                        <li className={"text-white"}>
                            <Link href={"/noticias"}>
                                <a>
                                    <Image layout={"fixed"} width={30} height={30} src={"/imgs/noticia-icon.svg"} alt={"icono de notificación"} /> Noticias
                                </a>
                            </Link>
                        </li>
                        <li className={"text-white"}>
                            <Link href={"/eventos"}>
                                <a>
                                    <Image layout={"fixed"} width={30} height={30} src={"/imgs/evento-icon.svg"} alt={"icono de notificación"} /> Eventos
                                </a>
                            </Link>
                        </li>
                    </ul>
                    <hr className={`${Styles.hr} mx-auto my-10 border-white`} />
                    <ul className={"px-5"}>
                        <li className={"text-white"}>
                            <Link href={"/notificaciones"}>
                                <a>
                                    <Image layout={"fixed"} width={30} height={30} src={"/imgs/notificaciones-icon.svg"} alt={"icono de notificación"} /> Notificaciones
                                </a>
                            </Link>
                        </li>
                        <li className={"text-white"}>
                            <Link href={"/configuracion"}>
                                <a>
                                    <Image layout={"fixed"} width={30} height={30} src={"/imgs/configuracion-icon.svg"} alt={"icono de notificación"} /> Configuración
                                </a>
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    )
}