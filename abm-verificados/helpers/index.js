export function getSessionStorage() {
    if (sessionStorage.getItem('datos')) {
        return JSON.parse(sessionStorage.getItem('datos'));
    }
}