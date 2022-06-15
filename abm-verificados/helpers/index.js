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

export function dateTime(data) {
    const date = new Date(data);
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
}

export function dateTimeLocal(data) {
    return data.toString().replace(' ','T');
}

export function previewImage(imagen) {
    return  URL.createObjectURL(imagen);
}