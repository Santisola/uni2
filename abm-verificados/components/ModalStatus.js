import Styles from '../styles/ModalStatus.module.css';

export default function ModalStatus({setModal}) {
    return (
        <div className={"w-screen h-screen bg-slate-900/75 fixed z-10 flex items-center justify-center inset-0"}>
            <div className={"w-4/5 bg-white relative py-10 px-5 rounded-lg"}>
                <button
                    aria-describedby={"cerrar modal"}
                    onClick={() => setModal(false)}
                    className={`${Styles.close} text-amber-400 py-5 rounded-full z-10`}
                >X</button>
                <p className={"font-semibold"}>Su usuario no ha sido verificado, complete los siguientes datos para acelerar su verificación. <br/>Nos contactaremos con usted a la brevedad</p>
                <button className={Styles.boton}>Completar los datos</button>
            </div>
        </div>
    )
}