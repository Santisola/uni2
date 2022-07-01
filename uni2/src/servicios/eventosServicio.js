import {API} from '../constantes/index';

let eventos = null;

const eventosServicio = {
    todos: async function(){
        const fetchRes = await fetch(API + '/eventos');
        const respuesta = await fetchRes.json();
        eventos = respuesta.eventos
        return [...eventos];
    },

    get: async function(id){
        const fetchRes = await fetch(API + '/eventos/' + id);
        const respuesta = await fetchRes.json();
        return respuesta.data;
    },
}

export default eventosServicio;