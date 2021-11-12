const storageServicio = {
    /**
     * Guarda los datos del usuario en localStorage
     * 
     * @param Object data 
     */
    setUsuario: function(data){
        localStorage.setItem('usuario', JSON.stringify(data));
    },

    /**
     * Guarda el token del usuario en localStorage
     * 
     * @param String token 
     */
    setToken: function(token){
        localStorage.setItem('token', token);
    },

    /**
     * Busca en localStorage los datos del usuario
     * 
     * Retorna un objeto con los datos del usuario o null si no hay usuario logueado 
     * @returns Object | null
     */
    getUsuario: function(){
        return JSON.parse(localStorage.getItem('usuario'));
    },

    /**
     * Busca el token del usuario en localStorage
     * 
     * @returns String | null
     */
    getToken: function(){
        return localStorage.getItem('token');
    },

    /**
     * Borra los datos del usuario de localStorage
     */
    deleteUsuario: function(){
        localStorage.removeItem('usuario');
    },

    /**
     * Borra el token del usuario de localStorage
     */
    deleteToken: function(){
        localStorage.removeItem('token');
    }
}

export default storageServicio;