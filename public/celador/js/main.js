let cupo = document.querySelector(".lugar");
let formReg = document.querySelector("#registro");
let contador2 = 0;

cupo.addEventListener("click",function(){
    if(contador2 == 0){
        formReg.style.display= "block";
        console.log();
        contador2=1;
    }else{
        formReg.style.display= "none";
        contador2 = 0;
    }
})



function actual() {
    var fecha = new Date(); //Actualizar fecha.
    var hora = fecha.getHours(); //hora actual
    var minuto=fecha.getMinutes(); //minuto actual
    var segundo=fecha.getSeconds(); //segundo actual
    if (hora<10) { //dos cifras para la hora
       hora="0"+hora;
       }
    if (minuto<10) { //dos cifras para el minuto
       minuto="0"+minuto;
       }
    if (segundo<10) { //dos cifras para el segundo
       segundo="0"+segundo;
       }
    //ver en el recuadro del reloj:
    var mireloj = hora+" : "+minuto+" : "+segundo;	
            return mireloj; 
    }
function actualizar() { //función del temporizador
var mihora=actual(); //recoger hora actual
var mireloj=document.getElementById("reloj"); //buscar elemento reloj
mireloj.innerHTML=mihora; //incluir hora en elemento
}
setInterval(actualizar,1000); //iniciar temporizador