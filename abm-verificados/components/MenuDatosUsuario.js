import Styles from "../styles/MenuDatosUsuario.module.css";
import Image from "next/image";
import {useEffect} from "react";

export default function MenuDatosUsuario({datos}) {
    /*console.log(datos);
    const id = 1;
    const URL = `${process.env.API_URL}verificado/${id}/infoUsuario`;
    console.log(URL)*/
    return (
        <div className={Styles.usuario}>
            <Image layout={"fixed"} width={50} height={50} src={"/imgs/user-default.png"} alt={"Imagen del usuario"}  />
            <div>
                <p className={"text-white text-lg font-semibold"}>Nombre Apellido</p>
                <p className={"text-white"}>email@correo.com</p>
            </div>
        </div>
    )
}