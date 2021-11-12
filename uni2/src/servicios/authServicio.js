import {API} from '../constantes/index';
import storageServicio from './storageServicio';

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
            const usuario =  {...respuesta.data};
            const token = respuesta.token;

            storageServicio.setUsuario(usuario);
            storageServicio.setToken(token);
            
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
                'Authorization': 'Bearer ' + storageServicio.getToken()
            }
        });

        const respuesta = await fetchRes.json();

        if (respuesta.success){
            storageServicio.deleteUsuario();
            storageServicio.deleteToken();
        }

        return respuesta.success;
    },

    registrar: async function(data){
        const fetchRes = await fetch(API + '/registro', {
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        });

        const respuesta = await fetchRes.json();

        return respuesta;
    },
    
    /**
     * Retorna un objeto con los datos del usuario autenticado
     * 
     * @returns Object | null
     */
    getUsuario: function(){
        return storageServicio.getUsuario();
    },


    /**
     * Retorna true si esta autenticado el usuario, de lo contrario false
     * 
     * @returns Boolean
     */
    estaAutenticado: function(){
        if(storageServicio.getUsuario() !== null){
            return true;
        }else{
            return false;
        }
    }
}

export default authServicio;