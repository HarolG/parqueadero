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
    
    let placa, documento, vehiculo, marca, modelo, color, soat, tecno, imagen;

    placa = document.getElementById("placa").value;
    documento = document.getElementById("documento").value;
    vehiculo = document.getElementById("vehiculo").value;
    marca = document.getElementById("marca").value;
    modelo = document.getElementById("modelo").value;
    color = document.getElementById("color").value;
    soat = document.getElementById("soat").value;
    tecno = document.getElementById("tecno").value;
    imagen = document.getElementById("imagen").value;

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
    }else if(soat == null || soat == 0){
        alert("Por favor, Adjunte el Archivo del SOAT");
        return false;    
    }else if(tecno == null || tecno == 0 ){
        alert("Por favor, Adjunte el Archivo de la Tecnomecanica");
        return false;    
    }else if(imagen == null || imagen == 0){
        alert("Por favor, Adjunte un Archivo de la Imagen del Vehiculo");
        return false;    
    }else if(isNaN(documento)){
        alert("El documento solo puede contener numeros")
        return false;
    };       
}