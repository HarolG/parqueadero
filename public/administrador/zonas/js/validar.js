function validar(){
    var tipozona, tipoestado, expresion;
    // cupo = document.getElementById("inputcupos").value;
    tipozona = document.getElementById("tipozona").value;
    tipoestado = document.getElementById("cupozona").value;

    if (tipozona === "") {
        alert("Por favor seleccione un tipo de zona!");
        return false;
    } else if (tipoestado === "") {
        alert("Por favor seleccione un tipo de estado!");
        return false;
    }
}