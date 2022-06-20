import Link from "next/link";

export default function UsuarioEliminado() {
    return (
        <p className={"py-5 text-center text-red-700 bg-red-400"}>Su cuenta a sido bloqueada. Si cree que es un error <Link href={'/configuracion'}>click aquí</Link></p>
    )
}