import Image from "next/image";
import FormLogin from "../components/FormLogin";
import Styles from '../styles/Login.module.css';
import Link from "next/link";
import Head from "next/head";
import {useRouter} from "next/router";

export default function Login() {
    const router = useRouter();

    return (
        <>
            <Head>
                <title>Unidos - Iniciar Sesión</title>
                <meta name="robots" content="index,follow" />
                <meta name="keywords" content="Unidos, mascotas, usuarios" />
                <link rel="icon" href={"/imgs/icon.svg"} />
            </Head>
            <div className={`${Styles.background} flex justify-center items-center w-screen h-screen flex-col`}>
                <Image layout={"fixed"} width={215} height={72} src={"/imgs/logo.svg"} alt={"Logo Unidos"} />
                <h1 className={"text-center text-4xl my-5"}>Iniciar Sesión</h1>
                <FormLogin
                    router={router}
                />
                <p>¿No tiene cuenta? <Link href={"/register"}><a className={Styles.registrarme}>Registrarme</a></Link></p>
            </div>
        </>
    )
}