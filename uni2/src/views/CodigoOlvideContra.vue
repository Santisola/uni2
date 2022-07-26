<template>
    <div>
        <h2>Ingresá el código que te enviamos por correo</h2>
        <p>¡Ingresá el código para poder reestablecer tu contraseña!</p>
        
        <form action="#" method="POST" @submit.prevent="">
            <div id="inputsContainer">
                <input
                    type="text"
                    name="codigo1"
                    id="codigo1"
                    maxlength="1"
                    v-model="codigo1"
                    placeholder="-"
                    @keypress="changeFocus"
                >
                <input
                    type="text"
                    name="codigo2"
                    id="codigo2"
                    maxlength="1"
                    v-model="codigo2"
                    placeholder="-"
                    @keypress="changeFocus"
                >
                <input
                    type="text"
                    name="codigo3"
                    id="codigo3"
                    maxlength="1"
                    v-model="codigo3"
                    placeholder="-"
                    @keypress="changeFocus"
                >
                <input
                    type="text"
                    name="codigo4"
                    id="codigo4"
                    maxlength="1"
                    v-model="codigo4"
                    placeholder="-"
                    @keypress="changeFocus"
                >
                <input
                    type="text"
                    name="codigo5"
                    id="codigo5"
                    maxlength="1"
                    v-model="codigo5"
                    placeholder="-"
                    @keypress="changeFocus"
                >
                <input
                    type="text"
                    name="codigo6"
                    id="codigo6"
                    maxlength="1"
                    v-model="codigo6"
                    placeholder="-"
                    @input="changeFocus"
                >
            </div>
            <div><button class="btn btn-primary">Validar</button></div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'CodigoOlvideContra',
    methods: {
        changeFocus: (ev) => {
            const target = ev.target.nextElementSibling;
            if(target){
                target.focus();
                target.select();
            }
        }
    },
    data() {
        return {
            codigo1: '',
            codigo2: '',
            codigo3: '',
            codigo4: '',
            codigo5: '',
            codigo6: '',
        }
    },
}
</script>

<style scoped>
h2{
    margin-bottom: .5rem;
}

#inputsContainer{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-top: 2rem;
}

#inputsContainer > input{
    display: block;
    width: 15%;
    min-width: 2rem;
    font-size: 1.25rem;
    padding: 1.25rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: solid 1px #cecece;
    border-radius: 4px;
    color: #2b2b2b;
    font-family: 'Montserrat';
}

form > div:last-of-type{
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
}
</style>