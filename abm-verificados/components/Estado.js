import Styles from "../styles/Estado.module.css";
import {useEffect, useState} from "react";
import ModalStatus from "./ModalStatus";

export default function Estado({status}) {
    const [modal,setModal] = useState(false);

    useEffect(() => {
        if (status === 1) {
            console.log('Usuario Verificado');
        } else {
            console.log('Usuario no verificado')
        }
    },[status])

    return (
        <div>
            <p className={"mt-5 text-center text-white flex gap-2 mx-auto items-center justify-center"}>Estado
                <button
                    className={Styles.pregunta}
                    onClick={(e) => {setModal(!modal)}}
                >
                    ?
                    <span className={`animate-ping ${Styles.ping}`}></span>
                </button>
            </p>
            {modal && (
                <ModalStatus
                    setModal={setModal}
                />
            )}
        </div>
    )
}