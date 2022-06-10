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
            { datos.imagen !== null ? (
                    // eslint-disable-next-line @next/next/no-img-element
                <img width={50} height={50} src={process.env.API_IMAGEN + datos.imagen} alt={`Foto de ${datos.razon_social}`} />
            ) : (
                // eslint-disable-next-line @next/next/no-img-element
                    <img width={50} height={50} src={"/imgs/user-default.png"} alt={"Imagen predeterminada para usuario"}  />
                )
            }
            <div className={"overflow-hidden"}>
                <p className={"text-white text-lg font-semibold"}>{datos.razon_social}</p>
                {datos.email?.length > 20 ? (
                    <div className={"flex"}>
                        <p className={`${Styles.email} text-white mr-5`}>{datos.email}</p>
                        <p className={`${Styles.email} text-white`}>{datos.email}</p>
                    </div>
                ) : (
                    <p className={"text-white"}>{datos.email}</p>
                )}
            </div>
        </div>
    )
}