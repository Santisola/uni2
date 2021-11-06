<template>
    <div id="login">
        <div class="login-header">
            <h1>Login</h1>
        </div>
        <div class="login-body">
            <p>Sumate a la comunidad de Unidos y reencontrate con tu mascota</p>

            <form action="#" @submit.prevent="$router.push('/')">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="text" id="login-email" name="email">
                </div>

                <div class="form-group">
                    <label for="login-password">Contraseña</label>
                    <div><input :type="verContra ? 'text' : 'password'" id="login-password" name="email"><span @click="verContra = !verContra">{{verContra ? 'Ocultar' : 'Mostrar'}}</span></div>
                </div>
                <a href="#">Olvidé mi contraseña</a>
                <div class="btn-link">
                    <button class="btn btn-primary">Iniciar Sesión</button>
                    <p>¿No tenés cuenta? <router-link to="/registro"> Registrate</router-link></p>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    name: "Login",
    data() {
        return {
            verContra: false,
        }
    },
}
</script>
<style scoped>
    .login-header{
        background: var(--secondary);
        margin: -1rem;
        height: 30vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-header h1{
        width: fit-content;
        text-align: center;
        width: 40%;
        height: 100px;
        font-size: 0;
        background: url("../assets/logo.svg");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .login-body{
        background-color: #fff; 
        margin: -1rem;
        margin-bottom: 0;
        width: 100%;
        padding: 1rem;
        border-radius: 16px 16px 0 0;
        position: absolute;
        bottom: 0;
        height: 72vh;
    }

    .login-body > p{
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 24px;
    }

    .form-group > label{
        padding-bottom: .5rem;
        font-style: normal;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        color: #222;
    }

    .form-group > div{
        border: solid 1px #cecece;
        background-color: #fff;
        border-radius: 4px;
        display: flex;
        align-items: center;
    }

    .form-group > div > input{
        border: 0;
    }

    .form-group > div > span{
        margin-right: .5rem;
        color: #969696;
        font-size: 16px;
        font-weight: 600;
    }

    form > a{
        color: var(--primary);
        display: block;
        width: fit-content;
        font-size: 14px;
        font-weight: 800;
        margin: 1rem 0;
    }

    .btn{
        width: 100%;
        padding: .75rem 0;
    }

    .btn-link p{
        color: #969696;
        font-size: 14px;
        text-align: center;
        padding: 1rem 0;
    }

    .btn-link a{
        color: var(--primary);
        font-weight: bold;
    }
</style>