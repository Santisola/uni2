import Head from "next/head";
import Footer from "../components/Footer";
import Header from "../components/Header";

export default function Layout({ children, pagina, title, datosUsuario }) {
    return(
        <>
            <Head>
                <title>Unidos - {title}</title>
                <meta name="robots" content="index,follow" />
                <meta name="keywords" content="Unidos, mascotas, usuarios" />
                <link rel="icon" href={"/imgs/icon.svg"} />
            </Head>
            <Header
                pagina={pagina}
                datosUsario={datosUsuario}
            />
            <main className={"mx-auto my-5"}>
                {children}
            </main>
            <Footer />
        </>
    )
}