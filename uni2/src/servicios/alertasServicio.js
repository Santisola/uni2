import API from '../constantes/index';

let alertas = null;

const alertasServicio = {
    todos: async function(){
        const fetchRes = await fetch(API + '/alertas');
        const respuesta = await fetchRes.json();
        alertas = respuesta.data
        return [...alertas];
    }
}

export default alertasServicio;