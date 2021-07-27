$(document).ready(function () {

    $('#search_notificacion').click(function (e) {
        // $('#search_notificacion').removeClass('notificacion_busqueda-error');
        // $('#search_notificacion').removeClass('notificacion_busqueda-exito');
        $('#search_notificacion').fadeOut();
    });

    $('#form_search_vehiculo').submit(function (e) {
        e.preventDefault();

        let postData = {
            estado: 'Consultar',
            placa: $('#search_placa').val()
        }

        $.post("php/class_vehiculo.php", postData,
            function (response) {

                if (response != 'badConsulta') {
                    const respuesta = JSON.parse(response)
                    console.log(respuesta)

                    notificacionExitosa('Éxito, el vehiculo fue encontrado correctamente')

                    let template = `<div class="card-header text-center">
                                    Información del vehiculo
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Tabla con la información del vehiculo</h5>
                                        <table class="table container">
                                            <thead>
                                                <tr>
                                                    <th>Placa</th>
                                                    <th>Modelo</th>
                                                    <th>Marca</th>
                                                    <th>Tipo de Vehiculo</th>
                                                    <th>Color</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="">
                                                    <td scope="row">${respuesta.placa}</td>
                                                    <td>${respuesta.nom_modelo}</td>
                                                    <td>${respuesta.nom_marca}</td>
                                                    <td>${respuesta.nom_tipo_vehiculo}</td>
                                                    <td>${respuesta.nom_color}</td>
                                                    <td>${respuesta.nom_estado}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="otra_informacion container">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="archivos/thumb2-lamborghini-aventador-sv-superveloce-lp-750-2018-purple-sports-car.jpg"
                                                        style="width: 100%;" alt="Foto Vehiculo">
                                                    <p class="btn btn-block btn-primary">Foto del Vehiculo</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Anotaciones</label>
                                                    <textarea name="" id="" cols="30" rows="4" disabled>${respuesta.anotaciones}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <form action="" class="container">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="button" name="" id="boton_search-actualizar" class="btn btn-primary form-control"
                                                            value="ACTUALIZAR DATOS">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="button" name="" id="boton_search-eliminar" class="btn btn-danger form-control"
                                                            value="ELIMINAR REGISTRO">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="button" name="" id="boton_search-owner" class="btn btn-info form-control"
                                                            value="CONSULTAR DUEÑOS">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>`;

                    $('#crud_container').html(template);

                    $('#boton_search-actualizar').click(function (e) {
                        e.preventDefault();
                        actualizarDatos(postData.placa);
                    });

                    $('#boton_search-eliminar').click(function (e) {
                        e.preventDefault();
                        if (confirm('¿Estás seguro de eliminar este registro?')) {
                            eliminarRegistro(postData.placa);
                        }
                    });

                } else {
                    notificacionErronea('Error, el vehiculo no fue encontrado en los registros');
                }

            }
        );

    });

    function notificacionExitosa(notificacion) {
        $('#search_notificacion').fadeIn();
        $('#search_notificacion').removeClass('notificacion_busqueda-error');
        $('#search_notificacion').addClass('notificacion_busqueda-exito');
        $('#search_notificacion').text(notificacion);
    }

    function notificacionErronea(notificacion) {
        $('#search_notificacion').fadeIn();
        $('#search_notificacion').fadeIn();
        $('#search_notificacion').removeClass('notificacion_busqueda-exito');
        $('#search_notificacion').addClass('notificacion_busqueda-error');
        $('#search_notificacion').text(notificacion);
    }

    function actualizarDatos(placa) {
        let postData = {
            estado: 'Actualizar',
            placa: placa
        }

        abrirModalUpdate(placa)

    }

    function abrirModalUpdate(placa) {
        let postData = {
            estado: 'preEditar-datos',
            placa: placa
        }

        $.post("php/class_vehiculo.php", postData,
            function (response) {

                if (response != 'badConsulta') {
                    const respuesta = JSON.parse(response)
                    console.log(respuesta)
                    
                    let template = `<div class="card-header text-center">
                                Formulario para actualizar el vehiculo
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center"></h5>
                                <form class="container" id="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Digite la placa</label>
                                                <input type="text" class="form-control" id="form_update-placa" value="${respuesta.placa}">
                                            </div>
                                            <div class="form-group">
                                                <label for="form_update-modelo">Elija el modelo</label>
                                                <select name="" id="form_update-modelo" class="form-control">
                                                    <option value="0" selected>Seleccione el modelo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_update-marca">Elija la marca</label>
                                                <select name="" id="form_update-marca" class="form-control">
                                                    <option value="0" selected>Seleccione la marca</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_update-marca">Elija el color</label>
                                                <select name="" id="form_update-color" class="form-control">
                                                    <option value="0" selected>Seleccione el color</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_update-tipoVehiculo">Elija el tipo de vehiculo</label>
                                                <select name="" id="form_update-tipoVehiculo" class="form-control">
                                                    <option value="0" selected>Seleccione el tipo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_update-anotacion">Digite la anotación</label>
                                                <input type="text" class="form-control" id="form_update-anotacion" value="${respuesta.anotaciones}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-block btn-primary" id="boton_actualizar" value="ACTUALIZAR">
                                            <a href="#" class="btn btn-block btn-danger" id="boton_cancelar">CANCELAR</a>
                                        </div>
                                    </div>
                                </form>
                            </div>`
                        
                    $('#search_vetanaModal-update').html(template);

                    let postData = {
                        estado: 'preEditar-select',
                        placa: placa
                    }

                    $.post("php/class_vehiculo.php", postData,
                        function (response) {
                            const data = JSON.parse(response)
                            let templateModelo = `<option value="0" selected>Seleccione el modelo</option>`
                            let templateMarca = `<option value="0" selected>Seleccione la marca</option>`
                            let templateColor = `<option value="0" selected>Seleccione el color</option>`
                            let templateTipoVeh = `<option value="0" selected>Seleccione el tipo</option>`

                            data.forEach(element => {

                                if(element.id_modelo) {
                                    templateModelo+= `<option value="${element.id_modelo}">${element.nom_modelo}</option>`
                                }

                                if(element.id_marca) {
                                    templateMarca+= `<option value="${element.id_marca}">${element.nom_marca}</option>`
                                }

                                if(element.id_color) {
                                    templateColor+= `<option value="${element.id_color}">${element.nom_color}</option>`
                                }

                                if(element.id_tipo_vehiculo) {
                                    templateTipoVeh+= `<option value="${element.id_tipo_vehiculo}">${element.nom_tipo_vehiculo}</option>`
                                }
                                
                            });

                            $('#form_update-modelo').html(templateModelo);
                            $('#form_update-marca').html(templateMarca);
                            $('#form_update-color').html(templateColor);
                            $('#form_update-tipoVehiculo').html(templateTipoVeh);
                        }
                    );

                    
                    $('#boton_actualizar').click(function (e) { 
                        e.preventDefault();
                        
                        let postData = {
                            estado: 'Actualizar',
                            placa: placa,
                            form_update_placa: $('#form_update-placa').val(),
                            form_update_modelo: $('#form_update-modelo').val(),
                            form_update_marca: $('#form_update-marca').val(),
                            form_update_color: $('#form_update-color').val(),
                            form_update_tipoVehiculo: $('#form_update-tipoVehiculo').val(),
                            form_update_anotacion: $('#form_update-anotacion').val()
                        }

                        $.post("php/class_vehiculo.php", postData,
                            function (response) {
                                alert(response)
                                window.location.reload();
                            }
                        );
                    });

                    $('#boton_cancelar').click(function (e) { 
                        e.preventDefault();
                        $('#search_vetanaModal-container').css('display', 'none');
                        $('#search_vetanaModal-update').css('display', 'none');
                    });

                    
                } else {
                    alert("Error en la consulta")
                }
            }
        );

        $('#search_vetanaModal-container').css('display', 'flex');
        $('#search_vetanaModal-update').css('display', 'block');
    }

    function eliminarRegistro(placa) {
        let postData = {
            estado: 'Eliminar',
            placa: placa
        }

        $.post("php/class_vehiculo.php", postData,
            function (response) {

                switch (response) {
                    case 'eliminarOk':
                        notificacionExitosa('El registro se ha borrado correctamente');
                        $('#crud_container').html("");
                        break;

                    case 'eliminarBad':
                        notificacionErronea('Ha ocurrido un error al intentar borrar el registro');
                        $('#crud_container').html("");
                        break;
                }
            }
        );
    }

});