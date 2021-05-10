function validar(){
    var cupos, expresion;
    cupos = document.getElementById("inputcupos").value;
    expresion = /^[A-Z]+$/i;

    if (cupos === "") {
        alert("Este campo no puede estar vacio!");
        return false;
    } else if (cupos.length>20) {
        alert("El tipo de zona es muy largo!");
        return false;
    } else if (cupos.length<5) {
        alert("El tipo de zona es muy corto");
        return false;
    } else if (!isNaN(cupos)) {
        alert("El tipo de zona no puede ser un numero");
        return false;
    } else if (!expresion.test(cupos)) {
        alert("El tipo de zona solo puede contener letras [A-Z] o [a-z], maximo 20 caracteres");
        return false;
    }
}