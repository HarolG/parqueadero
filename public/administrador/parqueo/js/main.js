
// Función imprimir() para abrir la ventana de impresion para visualizar el documento de reportes, imprimir o descargar en PDF
function imprimir(){
    var mywindow = window.open('', 'PRINT', 'height=1000,width=900', );
    mywindow.document.write('<html><head> <link rel="stylesheet" href="css/estilos.css">');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<div class= "img_repor"><img src="../../../img/logo_sena.png" width= "85px" height= "90px">&nbsp&nbsp<img src="../../../img/Logo_negro.png" width= "220px" height= "100px"></div><br><h2>REPORTE DE ENTRADAS Y SALIDAS PARQUEADERO</h2><br> ');
    // #tabla - id del contenedor de la tabla de reportes
    mywindow.document.write(document.querySelector('#tabla').innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); 
    mywindow.focus(); 
    mywindow.print();
    mywindow.close();
    return true;
}



// Función exportTableToExcel() convierte los datos de una tabla HTML a Excel, en concreto a un fichero XLS (.xls)
// Parametro tabla_ID : ID de la tabla HTML a exportar
// Parametro nom_docu : valor para el nombre del documento cada vez que se descarga 
function exportTableToExcel(tabla_ID, nom_docu = ''){

    // dataType nos permite simular la descarga de otro tipo de archivos, application/vnd.ms-excel
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tabla_ID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // añadir al nombre del documento la extencion de excel para poder ejecutarlo
    nom_docu = nom_docu?nom_docu+'.xls':'excel_data.xls';

    // Crear elemento para el enlace de descarga
    var downloadLink;
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
    var blob = new Blob(['ufeff', tableHTML], {
    type: dataType
    });
    navigator.msSaveOrOpenBlob( blob, nom_docu);
    }else{
    // Create a link to the file
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

    // Establecer el nombre del archivo
    downloadLink.download = nom_docu;

    // Activando la función
    downloadLink.click();
}
}


/* Modal */

const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
  el.addEventListener("click", function() {
    const modalId = this.dataset.open;
    document.getElementById(modalId).classList.add(isVisible);
  });
}

for (const el of closeEls) {
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
}

document.addEventListener("click", e => {
  if (e.target == document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});

document.addEventListener("keyup", e => {
  // if we press the ESC
  if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
    document.querySelector(".modal.is-visible").classList.remove(isVisible);
  }
});


