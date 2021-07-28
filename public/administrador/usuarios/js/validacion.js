function validacion() {
    let tipo_usuario, tipo_documento, documento, nombre, apellido, edad, celular, direccion, correo;
    tipo_usuario = document.getElementById("select_tip_user").value;
    tipo_documento = document.getElementById("select_tip_doc").value;
    documento = document.getElementById("docu").value;
    nombre = document.getElementById("nomb").value;
    apellido = document.getElementById("apel").value;
    edad = document.getElementById("eda").value;
    celular = document.getElementById("celuc").value;
    direccion = document.getElementById("direci").value;
    correo = document.getElementById("core").value;

    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    if (tipo_usuario === "") {
        alert("Seleccione un tipo de usuario");
        return false;
    } else if (tipo_documento === "") {
        alert("Seleccione un tipo de documento");
        return false;
    } else if (documento === "") {
        alert("El campo documento no puede estar vacio");
        return false;
    } else if (nombre === "") {
        alert("Complete el campo nombre");
        return false;
    } else if (apellido === "") {
        alert("Complete el campo apellido");
        return false;
    } else if (edad === "") {
        alert("Complete el campo edad");
        return false;
    } else if (celular === "") {
        alert("Complete el campo celular")
        return false;
    } else if (direccion === "") {
        alert("Complete el campo direccion");
        return false;
    } else if (correo === "") {
        alert("Complete el campo correo");
        return false;
    } else if (isNaN(celular)) {
        alert("El numero de celular no pude contener letras");
        return false;
    } else if (isNaN(edad)) {
        alert("La edad no puede contener letras");
        return false;
    } else if (isNaN(documento)) {
        alert("El documento no puede contener letras");
        return false;
    } else if (documento.length > 10) {
        alert("El documento es muy largo, debe tener entre 7 y 10 digitos solo numeros");
        return false;
    } else if (documento.length < 7) {
        alert("El documento es muy corto, debe tener entre 7 y 10 digitos solo numeros");
    }

}


function validacion2() {
    let tipo_usu, tipo_docu, docu, nom, ape, eda, cel, dir, cor, clave;
    tipo_usu = document.getElementById("tip_usu").value;
    tipo_docu = document.getElementById("tip_docu").value;
    docu = document.getElementById("doc").value;
    nom = document.getElementById("nom").value;
    ape = document.getElementById("ape").value;
    eda = document.getElementById("ed").value;
    cel = document.getElementById("celu").value;
    dir = document.getElementById("direc").value;
    cor = document.getElementById("cor").value;
    clave = document.getElementById("clave").value;

    regex = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;

    if (tipo_usu === "") {
        alert("Seleccione un tipo de usuario");
        return false;
    } else if (tipo_docu === "") {
        alert("Seleccione un tipo de documento");
        return false;
    } else if (docu === "") {
        alert("El campo documento no puede estar vacio");
        return false;
    } else if (nom === "") {
        alert("Complete el campo nombre");
        return false;
    } else if (ape === "") {
        alert("Complete el campo apellido");
        return false;
    } else if (eda === "") {
        alert("Complete el campo edad");
        return false;
    } else if (cel === "") {
        alert("Complete el campo celular")
        return false;
    } else if (dir === "") {
        alert("Complete el campo direccion");
        return false;
    } else if (cor === "") {
        alert("Complete el campo correo");
        return false;
    } else if (isNaN(cel)) {
        alert("El numero de celular no pude contener letras");
        return false;
    } else if (isNaN(eda)) {
        alert("La edad no puede contener letras");
        return false;
    } else if (isNaN(docu)) {
        alert("El documento no puede contener letras");
        return false;
    } else if (docu.length > 10) {
        alert("El documento es muy largo, debe tener entre 7 y 10 digitos solo numeros");
        return false;
    } else if (docu.length < 7) {
        alert("El documento es muy corto, debe tener entre 7 y 10 digitos solo numeros");
        return false;
    } else if (clave === "") {
        alert("La contraseña es obligatoria para usuarios administrativos");
        return false;
    } else if (clave.length < 8) {
        alert("La contraseña es muy corta, debe contener entre 8 y 15 caracteres");
        return false;
    } else if (clave.length > 15) {
        alert("La contraseña es muy larga, debe contener entre 8 y 15 caracteres")
        return false;
    } else if (regex.test(clave.value)) {
        alert("la contraseña no es valida debe contener una mayuscula, un numero y debe estar en el rango (8 y 15) caracteres");
        return false;
    }

}

function valid(){
    let tipodoc;

    tipodoc = document.getElementById("restipdoc").value;

    if (tipodoc === "") {
        alert("Por favor complete el campo tipo de documento");
        return false;
    } else if (tipodoc.length < 6) {
        alert("El tipo de documento es muy corto");
        return false;        
    } else if (tipodoc.length > 30) {
        alert("El tipo de documento es muy largo");
        return false;
    }
}

function val(){
    let tipousua, tipocategoria;

    tipousua = document.getElementById("resti").value;
    tipocategoria = document.getElementById("select_docu").value;

    if (tipousua === "") {
        alert("Por favor complete el campo tipo de usuario");
        return false;
    } else if (tipousua.length < 6) {
        alert("El tipo de usuario es muy corto");
        return false;
    } else if (tipousua.length > 30) {
        alert("el tipo de usuario es muy largo");
        return false;
    } else if (tipocategoria === "") {
        alert("Por favor seleccione una categoria");
        return false;
    }
}