function validarCuposDisponibles() {
    $.post("include/validarCuposDisponibles.php", {
            data: 'data'
        },
        function (data) {}
    );
}

validarCuposDisponibles();

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

    obtenerDatosUsuarioyVehiculos(codigo)

    let datosUsuarioyVehiculos = "";

    function obtenerDatosUsuarioyVehiculos(codigo) {
        let postData = {
            codigo: codigo,
            estado: 'Inicial'
            // vehiculo: $('#select_codigo_vehiculo').val()
        }

        $.post("include/class/codigoqr.php", postData,
            function (response) {

                switch (response) {

                    case "badUsuario":
                        alert("El código no se encuentra asociado a ningún usuario");
                        window.location.reload()
                        break;

                    case "okUsuario":
                        document.getElementById('select_codigo_1').style.display = "block";
                        document.getElementById('select_codigo_2').style.display = "block";
                        document.getElementById('select_codigo_3').style.display = "block";
                        break;

                    default:
                        alert("Ha ocurrido un error con el escaner, informe al administrador");
                }
            }
        );
    }

    $('#select_codigo_entrada').change(function (e) {
        let postData = {
            codigo: codigo,
            estado: 'buscarVehiculo',
            tipoEntrada: $('#select_codigo_entrada').val()
        }

        $.post("include/class/codigoqr.php", postData,
            function (response) {

                let template = `<option value="0" selected>Seleccione el vehiculo</option>`

                switch (response) {
                    case 'badVehiculo':
                        alert("No se ha encontrado ningún vehiculo compatible con este tipo de entrada");
                        template = `<option value="0" selected>Seleccione el vehiculo</option>`
                        $('#select_codigo_vehiculo').html(template);
                        break;

                    case 'badTipoEntrada':
                        template = `<option value="0" selected>Seleccione el vehiculo</option>`
                        $('#select_codigo_vehiculo').html(template);
                        break;

                    default:
                        let vehiculosEncontrados = JSON.parse(response);
                        let template2 = "";

                        vehiculosEncontrados.forEach(element => {
                            template += `<option value="${element.id_deta_vehiculo}">${element.placa}</option>`
                            template2 = `<label for="select_codigo_vehiculo">Documento y nombre del Propietario</label>     
                            <p class="form-control btn-block">${element.documento}-${element.nombre}</p>`
                        });

                        $('#select_codigo_vehiculo').html(template);
                        $('#select_codigo_3').html(template2);
                        break;
                }
            }
        );

    });

    $('#select_codigo_vehiculo').change(function (e) {

        let postData = {
            codigo: codigo,
            estado: 'registrarVehiculo',
            tipoEntrada: $('#select_codigo_entrada').val(),
            vehiculo: $('#select_codigo_vehiculo').val()
        }

        $.post("include/class/codigoqr.php", postData,
            function (response) {
                switch (response) {
                    case 'badTipoEntrada':
                        alert("El tipo de entrada no es valido");
                        break;
                    
                    case 'badZona':
                        alert("No se ha encontrado ninguna zona disponible para este tipo de vehiculo");
                        window.location.reload()
                        break;
                    
                    case 'badRegistro':
                        alert("Ha ocurrido un error al momento de registrar el vehiculo");
                        window.location.reload()

                    default: 
                        alert(response)
                        window.location.reload()
                }
            }
        );


    });

}