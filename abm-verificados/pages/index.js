import Layout from "../layouts/layout";
import Styles from '../styles/Home.module.css';
import Image from "next/image";
import Link from "next/link";

export default function Home() {
  return (
      <Layout
        pagina={"inicio"}
      >
          <h1 className={"text-lg font-semibold"}>Bienvenido Nombre y Apellido</h1>
          <p className={"mt-5"}>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam delectus facilis sapiente soluta.</p>
          <Link href={"/eventos"}>
              <div className={Styles.card}>
                  <Image layout={"fixed"} width={126} height={126} src={"/imgs/card-evento.svg"} alt={"Ver eventos"} />
                  <h2 className={"text-xl font-semibold"}>Eventos</h2>
              </div>
          </Link>
      </Layout>
  )
}
