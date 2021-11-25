import {API} from '../constantes/index';

let alertas = null;

const alertasServicio = {
    todos: async function(){
        const fetchRes = await fetch(API + '/alertas');
        const respuesta = await fetchRes.json();
        alertas = respuesta.data
        return [...alertas];
    },

    get: async function(id){
        const fetchRes = await fetch(API + '/alertas/' + id);
        const respuesta = await fetchRes.json();
        return respuesta.data;
    },

    nueva: async function(data){
        const fetchRes = await fetch(API + '/alertas', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        });
        const respuesta = await fetchRes.json();
        return respuesta;
    },

    editar: async function(data, id){
        const fetchRes = await fetch(API + '/alertas/' + id, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        });
        const respuesta = await fetchRes.json();
        return respuesta;
    },

    deUsuario: async function(id){
        const fetchRes = await fetch(API + '/usuario/' + id + '/alertas');
        const respuesta = await fetchRes.json();
        alertas = respuesta.data
        return [...alertas];
    },
    
    delete: async function(id){
        const fetchRes = await fetch(API + '/alertas/' + id, {
            method: 'DELETE'
        });
        const respuesta = await fetchRes.json();
        return respuesta.success
    }
}

export default alertasServicio;