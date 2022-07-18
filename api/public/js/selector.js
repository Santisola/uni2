document.addEventListener('DOMContentLoaded',() => {
    const formulario = document.querySelector('#formulario');
    const select = document.querySelector('#formulario select');

    select.addEventListener('change', () => {
        formulario.submit();
    });
});
