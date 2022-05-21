import Head from "next/head";
import Styles from "../styles/Login.module.css";
import Image from "next/image";
import Link from "next/link";
import FormRegister from "../components/FormRegister";
import {useRouter} from "next/router";

export default function Register() {
    const router = useRouter();
    return (
        <>
            <Head>
                <title>Unidos - Registrarse</title>
                <meta name="robots" content="index,follow" />
                <meta name="keywords" content="Unidos, mascotas, usuarios" />
                <link rel="icon" href={"/imgs/icon.svg"} />
            </Head>
            <div className={`${Styles.backgroundRegistro} flex justify-center items-center w-screen h-screen flex-col`}>
                <Image layout={"fixed"} width={215} height={72} src={"/imgs/logo.svg"} alt={"Logo Unidos"} />
                <h1 className={"text-center text-4xl my-5"}>Registrarse</h1>
                <FormRegister
                    router={router}
                />
                <p>¿Ya tiene cuenta? <Link href={"/login"}><a className={Styles.registrarme}>iniciar sesión</a></Link></p>
            </div>
        </>
    )
}