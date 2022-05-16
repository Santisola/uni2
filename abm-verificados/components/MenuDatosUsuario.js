import Styles from "../styles/MenuDatosUsuario.module.css";
import Image from "next/image";
import {useEffect, useState} from "react";

export default function MenuDatosUsuario({datosUsario}) {
    const [datos, setDatos] = useState({
        nombre: 'Nombre',
        apellido: 'Apellido',
        email: 'email@correo.com',
        imagen: null
    });

    useEffect(() => {
       if (datosUsario.length > 0) {
           const { nombre, apellido, email, imagen } = datosUsario[0];
           setDatos({
               nombre: nombre,
               apellido: apellido,
               email: email,
               imagen: imagen
           })
       }
    },[datosUsario]);

    return (
        <div className={Styles.usuario}>
            <Image layout={"fixed"} width={50} height={50} src={datos.imagen !== null ? datos.imagen : "/imgs/user-default.png"} alt={"Imagen del usuario"}  />
            <div>
                <p className={"text-white text-lg font-semibold"}>{datos.nombre} {datos.apellido}</p>
                <p className={"text-white"}>{datos.email}</p>
            </div>
        </div>
    )
}