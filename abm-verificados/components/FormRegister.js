import {useState} from "react";
import Styles from '../styles/LoginForm.module.css';

export default function FormRegister() {
    const [cuit,setCuit] = useState('');
    const [email,setEmail] = useState('');
    const [password,setPassword] = useState('');
    const [repeatPassword,setRepeatPassword] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        console.log(cuit);
        console.log(email);
        console.log(password);
        console.log(repeatPassword);

        const data = {
            cuit,
            email,
            password
        }

        try {
            const url = 'http://localhost/uni2/api/public/api/verificado/login';
            const respuesta = await fetch(url, {
                method: 'POST',
                mode:"cors",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json"
                }
            });
            const resultado = await respuesta.json();
            console.log(resultado);
        }
        catch (e) {
            console.error(e);
        }
    }

    return (
        <form
            className={`${Styles.form} flex flex-col items-center justify-center`}
            onSubmit={e => handleSubmit(e)}
        >
            <div className={Styles.inpiutContainer}>
                <label
                    className={"text-lg"}
                    htmlFor={"cuit"}>Cuit</label>
                <input
                    type={"number"}
                    name={"cuit"}
                    id={"cuit"}
                    value={cuit}
                    onChange={e => setCuit(e.target.value)}
                    placeholder={"Ingrese su CUIT aquí"}
                />
                <small>CUIT sin guiones ni espacios</small>
            </div>
            <div className={Styles.inpiutContainer}>
                <label
                    className={"text-lg"}
                    htmlFor={"email"}>Email</label>
                <input
                    type={"email"}
                    name={"email"}
                    id={"email"}
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    placeholder={"Ingrese su email aquí"}
                />
            </div>
            <div className={Styles.inpiutContainer}>
                <label
                    className={"text-lg"}
                    htmlFor={"password"}>Contraseña</label>
                <input
                    type={"password"}
                    name={"password"}
                    id={"password"}
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    placeholder={"Ingrese su contraseña aquí"}
                />
            </div>
            <div className={Styles.inpiutContainer}>
                <label
                    className={"text-lg"}
                    htmlFor={"repeatPassword"}>Repetir Contraseña</label>
                <input
                    type={"password"}
                    name={"repeatPassword"}
                    id={"repeatPassword"}
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    placeholder={"Repita su contraseña aquí"}
                />
            </div>
            <div className={Styles.inpiutContainer}>
                <input
                    type={"submit"}
                    value={"Registrarse"}
                />
            </div>
        </form>
    )
}