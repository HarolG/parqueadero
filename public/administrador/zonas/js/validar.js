function validar(){
    var tipozona, tipoestado;
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

function valid() {
    let zona, cantidad, estado;
    zona = document.getElementById("id_zona").value;
    cantidad = document.getElementById("nombre_cupo").value;
    estado = document.getElementById("estado_cupo").value;


    if (zona === "") {
        alert("Por favor seleccione una zona!");
        return false;
    } else if (cantidad === "") {
        alert("El campo cantidad de cupos no puede estar vacio");
        return false;
    } else if (isNaN(cantidad)) {
        alert("Por favor solo digite numeros en este campo!");
        return false;
    } else if (estado === "") {
        alert("Por favor seleccione un estado para el cupo!")
        return false;
    }
}