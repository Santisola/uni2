import Styles from "../styles/Estado.module.css";
import {useEffect, useState} from "react";
import ModalStatus from "./ModalStatus";

export default function Estado({ status }) {
    const [modal,setModal] = useState(false);
    const [verificado, setVerificado] = useState(false);

    useEffect(() => {
        console.log(status)
        if (status === 1) {
            setVerificado(true)
        } else {
            setVerificado(false);
        }
    },[status])

    return (
        <div>
            <p className={"mt-5 text-center text-white flex gap-2 mx-auto items-center justify-center"}>Estado
                { verificado ? (
                    <abbr title="Está verificado">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="#5C3AE2" viewBox="0 0 24 24"
                             stroke="currentColor" strokeWidth="2">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                  d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </abbr>
                ) : (
                    <button
                        className={Styles.pregunta}
                        onClick={(e) => {setModal(!modal)}}
                    >
                        ?
                        <span className={`animate-ping ${Styles.ping}`}></span>
                    </button>
                )}

            </p>
            {modal && (
                <ModalStatus
                    setModal={setModal}
                />
            )}
        </div>
    )
}