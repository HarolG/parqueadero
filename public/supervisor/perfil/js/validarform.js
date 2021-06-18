function validarformulario(){
    let nombre, apellido, edad, celular, direccion, correo;
    // cupo = document.getElementById("inputcupos").value;
    nombre = document.getElementById("nombre").value;
    apellido = document.getElementById("apellido").value;
    edad = document.getElementById("edad").value;
    celular = document.getElementById("celular").value;
    direccion = document.getElementById("direccion").value;
    correo = document.getElementById("correo").value;

    if (nombre === "") {
        alert("Por favor diligencie el campo nombre");
        return false;
    } else if (apellido === "") {
        alert("Por favor diligencie el campo apellido");
        return false;
    } else if (edad === "") {
        alert("Por favor diligencie el campo edad");
        return false;
    } else if (celular === "") {
        alert("Por favor diligencie el campo celular");
        return false;
    } else if (direccion === "") {
        alert("Por favor diligencie el campo direccion");
        return false;
    } else if (correo === "") {
        alert("Por favor diligencie el campo correo");
        return false;
    }   
    // } else if (nombre.length > 30) {
    //     alert("El nombre es muy largo debe tener menos de 30 caracteres");
    //     return false;
    // } else if (!nombre.length < 3) {
    //     alert("El nombre es muy corto debe tener minimo 3 caracteres");
    //     return false;
    // }
    // } else if (!isNaN(nombre)) {
    //     alert("El nombre no pude ser un numero");
    //     return false;
    // } else if (!isNaN(apellido)) {
    //     alert("El apellido no pude ser un numero");
    //     return false;
    // }
}