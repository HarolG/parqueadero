function validar(){
    var cupo, tipozona, tipoestado, expresion;
    cupo = document.getElementById("inputcupos").value;
    tipozona = document.getElementById("tipozona").value;
    tipoestado = document.getElementById("cupozona").value;

    if (tipozona === "") {
        alert("Por favor seleccione un tipo de zona!");
        return false;
    } else if(cupo === "") {
        alert("Por favor digite una cantidad de cupos!");
        return false;
    } else if (tipoestado === "") {
        alert("Por favor seleccione un tipo de estado!");
        return false;
    } else if (isNaN(cupo)) {
        alert("Solo puede digitar numeros, en el campo ingrese cantidad de cupos!");
        return false;
    }
}