export const formatearTel = telefono => {
    const limpiar = ('' + telefono).replace(/\D/g, '');
    const match = limpiar.match(/^(2|)?(\d{2})(\d{4})(\d{4})$/);
    if (match) {
        const intlCode = (match[1] ? '+54 ' : '');
        return [intlCode, '(', match[2], ') ', match[3], '-', match[4]].join('');
    }
    return null;
}
