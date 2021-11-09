import {API} from '../constantes/index';

let usuario = {
    id_usuario: null,
    email: null,
    nombre: null
};

let token = null;

const authServicio = {
    login: async function(data){
        const fetchRes = await fetch(API + '/login', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        const respuesta = await fetchRes.json();

        if (respuesta.success){
            usuario =  {...respuesta.data};
            token = respuesta.token;

            return true;
        }else{
            return false;
        }
    },

    logout: async function (){
        const fetchRes = await fetch(API + '/logout', {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': 'Bearer ' + token
            }
        });
        const respuesta = await fetchRes.json();
        return respuesta.success;
    },

    getUsuario: function(){
        return {...usuario};
    }
}

export default authServicio;