import Styles from "../styles/MenuDatosUsuario.module.css";
import Image from "next/image";
import {useEffect, useState} from "react";

export default function MenuDatosUsuario({datosUsuario}) {
    const [datos, setDatos] = useState({
        razon_social: 'Nombre Apellido',
        email: 'email@correo.com',
        imagen: null,
        tel: null,
    });

    useEffect(() => {
        setDatos({
            razon_social: datosUsuario.razon_social,
            email: datosUsuario.email,
            imagen: datosUsuario.imagen,
            tel: datosUsuario.telefono
        });
    },[datosUsuario]);

    return (
        <div className={Styles.usuario}>
            { datos.imagen ? (
                <img width={50} height={50} src={process.env.API_IMAGEN + datos.imagen} alt="Foto de perfil" />
            ) :
                (<Image layout={"fixed"} width={50} height={50} src={"/imgs/user-default.png"} alt={"Imagen del usuario"}  />)
            }
            <div>
                <p className={"text-white text-lg font-semibold"}>{datos.razon_social}</p>
                <p className={`${Styles.email} text-white`}>{datos.email}</p>
            </div>
        </div>
    )
}