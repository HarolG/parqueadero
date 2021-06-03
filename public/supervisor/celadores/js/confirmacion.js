function confirmacion(e) {
    if (confirm("¿Esta seguro de eliminar esta zona?")) {
        return true;
    } else {
        e.preventDefault();
    }
}
let linkdelete = document.querySelectorAll(".eliminarlink");

for (var i = 0; i < linkdelete.length; i++) {
    linkdelete[i].addEventListener('click', confirmacion);
}   