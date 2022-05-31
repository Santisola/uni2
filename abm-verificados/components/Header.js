import Link from "next/link";
import Image from "next/image";
import Styles from '../styles/Header.module.css';
import { useState } from "react";
import Menu from "./Menu";
import FormCompletar from "../formularios/FormCompletar";

export default function Header({ pagina, datosUsuario }) {
    const [abierto, setAbierto] = useState(false);

    return (
        <header className={`${Styles.header} p-5`}>
            <Link href={"/"}>
                <a className={"w-1/3"}><Image layout={"fixed"} width={100} height={30} src={"/imgs/logo.svg"} alt={"Logo"}  /></a>
            </Link>
            <div className={Styles.buttonContainer}>
                <button
                    className={`${Styles.button} ${abierto ? Styles.open : ''}`}
                    onClick={() => {setAbierto(!abierto)}}
                >
                    <span></span>
                </button>
            </div>
            <h1 className={`${Styles.pagina} text-lg text-center uppercase w-full`}>{pagina}</h1>
            <Menu
                setAbierto={setAbierto}
                abierto={abierto}
                datosUsuario={datosUsuario}
            />
        </header>
    )
}