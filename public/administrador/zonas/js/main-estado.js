function validar(){
    var estado, expresion;
    estado = document.getElementById("inputcupos").value;
    expresion = /^[A-Z]+$/i;

    if (estado === "") {
        alert("Este campo no puede estar vacio!");
        return false;
    } else if (estado.length>20) {
        alert("El tipo de estado es muy largo!");
        return false;
    } else if (estado.length<5) {
        alert("El tipo de estado es muy corto");
        return false;
    } else if (!isNaN(estado)) {
        alert("El tipo de estado no puede ser un numero");
        return false;
    } else if (!expresion.test(estado)) {
        alert("El tipo de estado solo puede contener letras [A-Z] o [a-z], maximo 20 caracteres");
        return false;
    }
}