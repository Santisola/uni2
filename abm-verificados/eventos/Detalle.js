import {dateTime} from "../helpers";
import Styles from '../styles/DetalleEvento.module.css';

export default function Detalle({ nombre, descripcion, imagen, hasta, desde, publicado, updated_at, created_at }) {
    return (
        <>
            <div>
                <picture>
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src={process.env.API_IMAGEN + imagen} alt={`${nombre}. Imagen del evento`} />
                </picture>
            </div>
            <h2 className={"text-xl text-center font-semibold my-5"}>{nombre}</h2>
            <p className={Styles.descripcion}>{descripcion}</p>
            <dl className={"mt-5"}>
                <dt className={"font-bold"}>Fechas:</dt>
                <dl className={"font-semibold"}>Desde: <span className={Styles.fechas}>{dateTime(desde)}</span></dl>
                <dl className={"font-semibold"}>Hasta: <span className={Styles.fechas}>{dateTime(hasta)}</span></dl>
                <div className={"mt-3 flex w-full"}>
                    <dt className={"font-bold"}>Status:</dt>
                    <dl className={Styles.status}>{publicado === 1 ? 'Publicado' : 'Borrador' }</dl>
                </div>
            </dl>
            <ul className={"mt-5"}>
                <li className={"text-sm"}>Creado el: <span className={Styles.timestamp}>{dateTime(created_at)}</span></li>
                <li className={"text-sm"}>Última modificación: <span className={Styles.timestamp}>{dateTime(updated_at)}</span></li>
            </ul>
            <button
                type={"button"}
                className={Styles.boton}
            >Modificar</button>
        </>
    )
}