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





//ventana modal de tipo de vehiculo

window.addEventListener("click",e => {
    if (e.target.matches("#ventana1")){
        e.preventDefault();
        document.querySelector(".ventana-modal1").classList.add("aparecer")
    }
    if(e.target.matches(".close") || e.target.matches(`.close *`)){
        e.preventDefault();
        document.querySelector(".ventana-modal1").classList.remove("aparecer")
    }
})

//ventana modal de Marca
window.addEventListener("click",e => {
    if (e.target.matches("#ventana2")){
        e.preventDefault();
        document.querySelector(".ventana-modal2").classList.add("aparecer2")
    }
    if(e.target.matches(".cerrar") || e.target.matches(`.cerrar *`)){
        e.preventDefault();
        document.querySelector(".ventana-modal2").classList.remove("aparecer2")
    }
})

//ventana modal de Modelo

window.addEventListener("click",e => {
    if (e.target.matches("#ventana3")){
        e.preventDefault();
        document.querySelector(".ventana-modal3").classList.add("aparecer3")
    }
    if(e.target.matches(".x") || e.target.matches(`.x *`)){
        e.preventDefault();
        document.querySelector(".ventana-modal3").classList.remove("aparecer3")
    }
})

//ventana modal de Color
window.addEventListener("click",e => {
    if (e.target.matches("#ventana4")){
        e.preventDefault();
        document.querySelector(".ventana-modal4").classList.add("aparecer4")
    }
    if(e.target.matches(".x") || e.target.matches(`.x *`)){
        e.preventDefault();
        document.querySelector(".ventana-modal4").classList.remove("aparecer4")
    }
})
