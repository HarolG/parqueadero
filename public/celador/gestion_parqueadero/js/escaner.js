var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
        fps: 30,
        qrbox: 250
    });

function onScanSuccess(decodedText, decodedResult) {
    // Manejar en condición de éxito con el texto decodificado o el resultado.
    // console.log(`Scan result: ${decodedText}`, decodedResult);
    let resultado = `${decodedText}`;
    validarIngresoParqueadero(resultado)
    // ...
    html5QrcodeScanner.clear();
    // ^ Detiene el escaner una vez se complete el escaneo
}

function onScanError(errorMessage) {
    console.log(errorMessage)
}


html5QrcodeScanner.render(onScanSuccess, onScanError);

$('#boton_codigo').click(function (e) { 
    e.preventDefault();
    document.getElementById("codigo_container-general").style.display = "flex";
});

$('#boton_codigo-cancelar').click(function (e) { 
    e.preventDefault();
    document.getElementById("codigo_container-general").style.display = "none";
});

function validarIngresoParqueadero(codigo) {

    noc()

    function noc () {
        let postData = {
            codigo: codigo,
            vehiculo: $('#select_codigo_vehiculo').val()
        }
    
        $.post("include/class/codigoqr.php", postData,
            function (response) {
                const data = JSON.parse(response);
                let template = `<option value="0" selected>Seleccione el vehiculo</option>`;

                data.forEach(element => {
                    template += `
                                    <option value="${element.id_deta_vehiculo}">${element.placa}</option>
                    `
                });

                document.getElementById("select_codigo_vehiculo").style.display = "block";
                $('#select_codigo_vehiculo').html(template);

            }
        );
    }

    $('#select_codigo_vehiculo').change(function (e) {

        let postData = {
            codigo: codigo,
            vehiculo: $('#select_codigo_vehiculo').val()
        }

        $.post("include/class/codigoqr.php", postData,
            function (response) {
                alert(response)
                window.location.reload()
            }
        );

        
    });

}