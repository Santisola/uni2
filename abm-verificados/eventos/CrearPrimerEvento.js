import Image from "next/image";

export default function CrearPrimerEvento() {
    return (
        <>
            <h2 className={"text-xl font-semibold text-center my-10"}>No tienes ningún evento creado</h2>
            <div className={"flex justify-center items-center my-5"}>
                <Image
                    layout={"fixed"}
                    width={250}
                    height={250}
                    src={'/imgs/no-event.svg'}
                    alt={"Crear un evento"}
                />
            </div>
        </>
    )
}