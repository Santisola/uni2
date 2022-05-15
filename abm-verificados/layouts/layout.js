import Head from "next/head";
import Footer from "../components/Footer";
import Header from "../components/Header";

export default function Layout({ children, pagina }) {
    return(
        <>
            <Head>
                <title>Unidos - {pagina}</title>
                <meta name="robots" content="index,follow" />
                <meta name="keywords" content="Unidos, mascotas, usuarios" />
                <link rel="icon" href={"/imgs/icon.svg"} />
            </Head>
            <Header
                pagina={pagina}
            />
            <main className={"mx-auto my-5"}>
                {children}
            </main>
            <Footer />
        </>
    )
}