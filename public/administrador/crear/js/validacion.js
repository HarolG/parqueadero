$(document).ready(function () {

    // Ventana Modal Tipo de vehiculo

    $('#ventana1').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal1').css('display', 'flex');
    });

    $('#cerrar_modal1').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal1').css('display', 'none');
    });

    // Ventana Modal Marca

    $('#ventana2').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal2').css('display', 'flex');
    });

    $('#cerrar_modal2').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal2').css('display', 'none');
    });

    // Ventana Modal Tipo de Modelo

    $('#ventana3').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal3').css('display', 'flex');
    });

    $('#cerrar_modal3').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal3').css('display', 'none');
    });

    // Ventana Modal Tipo de color

    $('#ventana4').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal4').css('display', 'flex');
    });

    $('#cerrar_modal4').click(function (e) { 
        e.preventDefault();
        $('#ventana-modal4').css('display', 'none');
    });
});



function enviarFormulario(){
    
    let placa, documento, vehiculo, marca, modelo, color;

    placa = document.getElementById("placa").value;
    documento = document.getElementById("documento").value;
    vehiculo = document.getElementById("vehiculo").value;
    marca = document.getElementById("marca").value;
    modelo = document.getElementById("modelo").value;
    color = document.getElementById("color").value;

    if(placa === "" ){
        alert("Por favor, diligencie el campo Placa");
        return false;
    } else if(documento === "" ){
        alert("Por favor, diligencie el campo Documento");
        return false;
    }else if(vehiculo == null || vehiculo == 0 ){
        alert("Por favor, Seleccione un Vehiculo");
        return false;
    }else if(marca == null || marca == 0){
        alert("Por favor, Seleccione la Marca del Vehiculo");
        return false;
    }else if(modelo == null || modelo == 0){
        alert("Por favor, Seleccione un Modelo del Vehiculo");
        return false;    
    }else if(color == null || color == 0){
        alert("Por favor, Seleccione el Color del Vehiculo");
        return false;    
    };       
}


function fileValidation(){
    var fileInput = document.getElementById('tarjeta');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor, seleccione archivos .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('tarjet').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

function fileValidation(){
    var fileInput = document.getElementById('imagen');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor, seleccione archivos .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('vehic').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

