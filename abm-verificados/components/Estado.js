import Styles from "../styles/Estado.module.css";

export default function Estado() {
    return (
        <p className={"mt-5 text-center text-white flex gap-2 mx-auto items-center justify-center"}>Estado
            <button
                className={Styles.pregunta}
            >
                ?
                <span className={`animate-ping ${Styles.ping}`}></span>
            </button>
        </p>
    )
}