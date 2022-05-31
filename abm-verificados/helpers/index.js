export function getSessionStorage() {
    if (sessionStorage.getItem('datos')) {
        return JSON.parse(sessionStorage.getItem('datos'));
    }
}

export function validateEmail(email) {
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}

export function fecha(fecha) {
    const date = new Date(fecha);
    return date.toLocaleDateString();
}