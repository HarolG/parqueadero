
// Función imprimir() para abrir la ventana de impresion para visualizar el documento de reportes, imprimir o descargar en PDF
function imprimir(){
    var mywindow = window.open('', 'PRINT', 'height=1000,width=900', );
    mywindow.document.write('<html><head> <link rel="stylesheet" href="css/estilos.css">');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<h2>REPORTE</h2><br><img src="../../../img/logo.png" width= "120px" height= "90px"> <br> ');
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