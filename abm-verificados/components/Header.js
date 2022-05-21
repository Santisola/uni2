import Link from "next/link";
import Image from "next/image";
import Styles from '../styles/Header.module.css';
import { useState } from "react";
import Menu from "./Menu";

export default function Header({ pagina, datosUsuario }) {
    const [abierto, setAbierto] = useState(false);

    return (
        <header className={`${Styles.header} py-10 px-5`}>
            <Link href={"/"}>
                <a className={"w-1/3"}><Image layout={"fixed"} width={100} height={30} src={"/imgs/logo.svg"} alt={"Logo"}  /></a>
            </Link>
            <p className={`${Styles.pagina} text-lg text-center uppercase w-1/3`}>{pagina}</p>
            <div className={Styles.buttonContainer}>
                <button
                    className={`${Styles.button} ${abierto ? Styles.open : ''}`}
                    onClick={() => {setAbierto(!abierto)}}
                >
                    <span></span>
                </button>
            </div>
            <Menu
                setAbierto={setAbierto}
                abierto={abierto}
                datosUsuario={datosUsuario}
            />
        </header>
    )
}