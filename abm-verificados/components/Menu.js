import Styles from "../styles/Menu.module.css";
import Image from "next/image";
import Link from "next/link";
import Estado from "./Estado";
import MenuDatosUsuario from "./MenuDatosUsuario";

export default function Menu({ setAbierto, abierto }) {
    return (
        <div
            className={`${Styles.background} ${ abierto ? Styles.aparecer : ''} w-1/3`}
            onClick={() => {setAbierto(!abierto)}}
        >
            <nav className={Styles.nav}>
                <MenuDatosUsuario />
                <Estado />
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
    )
}