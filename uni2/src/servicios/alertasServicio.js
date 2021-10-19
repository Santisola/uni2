import API from '../constantes/index';

let alertas = null;

const alertasServicio = {
    todos: async function(){
        const fetchRes = await fetch(API + '/alertas');
        const respuesta = await fetchRes.json();
        alertas = respuesta.data
        return [...alertas];
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
        return respuesta.success;
    }
}

export default alertasServicio;