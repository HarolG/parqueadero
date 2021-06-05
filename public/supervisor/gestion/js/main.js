function confirmacion(e) {
    if (confirm("¿Esta seguro de inhabilitar este usuario?")) {
        return true;
    } else {
        e.preventDefault();
    }
}

function habilitar(e) {
    if (confirm("¿Esta seguro de habilitar este usuario?")) {
        return true;
    } else {
        e.preventDefault();
    }
}

function incapacitar(e) {
    if (confirm("¿Esta seguro de darle una incapacidad a este usuario?")) {
        return true;
    } else {
        e.preventDefault();
    }
}


let linkdelete = document.querySelectorAll(".eliminarlink2");
let linkhabilitar = document.querySelectorAll(".eliminarlink");
let incapacidad = document.querySelectorAll(".eliminarlink3")

for (var i = 0; i < linkdelete.length; i++) {
    linkdelete[i].addEventListener('click', confirmacion);
}

for (var i = 0; i < linkhabilitar.length; i++) {
    linkhabilitar[i].addEventListener('click', habilitar);
}

for (var i = 0; i < incapacidad.length; i++) {
    incapacidad[i].addEventListener('click', incapacitar);
}



