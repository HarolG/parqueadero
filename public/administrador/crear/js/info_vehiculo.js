$(document).ready(function () {

    const formSearch = $('#form_info_vehiculo')

    $(formSearch).submit(function (e) {
        e.preventDefault();
        let placa = $('#search_vehiculo')

        buscarVehiculo(placa)
    });

    function datosPropietario() {
        $('#container_modal').css({
            'display': 'flex'
        })
        let documento = $('#documentoPropietario').text();

        $.post("php/datos_propietario.php", {
                documento
            },
            function (data) {
                let respuesta = JSON.parse(data)

                let template = `
                                    <form method="post" class="form_datos_propietario">
                                        <h3 style="text-align: center;">Datos del Propietario</h3>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Documento</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['documento']}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Apellido</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['apellido']}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Celular</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['celular']}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Correo</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['correo']}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['nombre']}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Edad</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['edad']}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" class="form-control" value="${respuesta[0]['direccion']}" disabled>
                                            </div>
                                        </div>
                                    </form>
                                    
                                `

                $('#container_gruposModales').html(template);
            }
        );
    }

    function buscarVehiculo(placa) {
        const placaVehiculo = placa

        $.ajax({
                method: "POST",
                url: "php/info_vehiculo.php",
                data: placaVehiculo
            })

            .done(function (response) {

                if (response == "No encontrado") {
                    alert("No existe ningún vehiculo con esa placa")
                } else {
                    const respuesta = JSON.parse(response)

                    if (respuesta[0] == "another_info") {
                        template = `
                            <table>
                                <thead>
                                    <th class="th_start">Placa</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Tipo de Vehiculo</th>
                                    <th>Documento</th>
                                    <th>Color</th>
                                    <th class="th_end">Acciones</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="placaVehiculo">${respuesta.placa}</td>
                                        <td>${respuesta.modelo}</td>
                                        <td>${respuesta.marca}</td>
                                        <td>${respuesta.tipo_vehiculo}</td>
                                        <td class="documento">
                                            <a href="#" id="documentoPropietario">${respuesta.documento}</a>
                                        </td>
                                        <td>${respuesta.color}</td>
                                        <td>
                                            <a href="#" class="edit">Editar</a>
                                            <a href="#" class="delete" id="btn_delete">Eliminar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        `
                        $('#table_container').html(template);
                        $('#documentoPropietario').click(function (e) {
                            datosPropietario()
                        });

                        $('#cerrarModal').click(function (e) { 
                            e.preventDefault();
                            $('html, body').css({
                                'overflow': 'auto',
                                'height': 'auto'
                            });
                    
                            $('#container_modal').css({
                                'display': 'none'
                            })
                        });
                    

                    } else {
                        template = `
                            <table>
                                <thead>
                                    <th class="th_start">Placa</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Tipo de Vehiculo</th>
                                    <th>Documento</th>
                                    <th>Color</th>
                                    <th class="th_end">Acciones</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="placaVehiculo">${respuesta.placa}</td>
                                        <td>${respuesta.modelo}</td>
                                        <td>${respuesta.marca}</td>
                                        <td>${respuesta.tipo_vehiculo}</td>
                                        <td class="documento">
                                            <a href="#" id="documentoPropietario">${respuesta.documento}</a>
                                        </td>
                                        <td>${respuesta.color}</td>
                                        <td>
                                            <a href="#" class="edit" id="edit_veh">Editar</a>
                                            <a href="#" class="delete" id="btn_delete">Eliminar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="container_another_info">
                                <div class="container_another_info-title">
                                <p>OTRA INFORMACIÓN</p>
                                </div>
                                <div class="column_container_anotherInfo">
                                    <div class="column_anotherInfo-izquierda">
                                        <img src="${respuesta.foto}" alt="Foto del vehiculo">
                                        <form enctype="multipart/form-data" id="form_cambiarImagen">
                                            <input type="file" name="imagenVehiculo" id="imagenVehiculo">
                                            <button type="submit" id="prueba">Cambiar Imagen</button>
                                        </form>
                                    </div>
                                    <div class="column_anotherInfo-derecha">
                                        <div class="grupo_anotherInfo">
                                            <p>Soat:</p>
                                            <a href="${respuesta.soat}" target="_blank">Ver Soat</a> 
                                            <form id="form_soat" enctype="multipart/form-data">
                                                <input type="file" name="foto_soat" id="foto_soat">
                                                <button type="submit">Actualizar</button>
                                            </form>
                                        </div>
                                        <div class="grupo_anotherInfo">
                                            <p>Tecnomecánica:</p>
                                            <a href="${respuesta.tecnomecanica}" target="_blank">Ver Tecnomecánica</a>
                                            <form id="form_tecno" enctype="multipart/form-data">
                                                <input type="file" name="foto_tecno" id="foto_tecno">
                                                <button type="submit">Actualizar</button>
                                            </form>
                                        </div>
                                        <div class="grupo_anotherInfo">
                                            <p>Anotaciones:</p>
                                            <small class="texto">${respuesta.anotaciones}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                        $('#table_container').html(template);

                        $('#documentoPropietario').click(function (e) {
                            datosPropietario()
                        });

                        $('#cerrarModal').click(function (e) { 
                            e.preventDefault();
                    
                            $('#container_modal').css({
                                'display': 'none'
                            })
                        });

                        $('#btn_delete').click(function (e) { 
                            e.preventDefault();
                            let placaVehiculo = $('#placaVehiculo').text();

                            if(confirm("¿Estás seguro de eliminar este vehiculo?")) {
                                $.post("php/eliminarveh.php", {placaVehiculo},
                                    function (response) {
                                        alert(response)
                                        window.location.reload(); 
                                    }
                                );
                            }

                        });

                        $('#form_cambiarImagen').submit(function (e) {
                            e.preventDefault();
                            let placaVehiculo_ = $('#placaVehiculo').text();
                            actualizarImagen("imagenVehiculo", "form_cambiarImagen", placaVehiculo_)
                            buscarVehiculo(placaVehiculo)
                        });
        
                        $('#form_soat').submit(function (e) { 
                            e.preventDefault();
                            let placaVehiculo_ = $('#placaVehiculo').text();
                            actualizarImagen("foto_soat", "form_soat", placaVehiculo_)
                            buscarVehiculo(placaVehiculo)
                        });
        
                        $('#form_tecno').submit(function (e) { 
                            e.preventDefault();
                            let placaVehiculo_ = $('#placaVehiculo').text();
                            actualizarImagen("foto_tecno", "form_tecno", placaVehiculo_)
                            buscarVehiculo(placaVehiculo)
                        });


                        $('#edit_veh').click(function (e) { 
                            e.preventDefault();

                            $('#container_modal').css({
                                'display': 'flex'
                            })

                            let placa = $('#placaVehiculo').text();

                            $.post("php/editar_veh.php", {placa},
                                function (response) {
                                    let respuesta = JSON.parse(response)

                                    let template = `
                                                    <form method="post" class="form_datos_propietario" id="form_datos_propietario">
                                                        <h3 style="text-align: center;">Editar el vehiculo</h3>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Placa</label>
                                                                <input type="text" class="form-control" value="${respuesta[0]["placa"]}" id="editar_placa" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Elija el modelo</label>
                                                                <select class="form-control" name="" id="select_modelo">
                                                                    ${selectModelo("modelo")}
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Elija la marca</label>
                                                                <select class="form-control" name="" id="select_marca">
                                                                    ${selectModelo("marca")}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Elija el tipo de vehiculo</label>
                                                                <select class="form-control" name="" id="select_tipo_vehiculo">
                                                                    ${selectModelo("tipo_vehiculo")}
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Elija el color</label>
                                                                <select class="form-control" name="" id="select_color">
                                                                    ${selectModelo("color")}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" value="Editar" class="btn btn-primary btn-block">
                                                        </div>
                                                    </form>
                                                    `

                                    $('#container_gruposModales').html(template);

                                    $('#form_datos_propietario').submit(function (e) { 
                                        e.preventDefault();
                                        
                                        const postData = {
                                            editar_placa: $('#editar_placa').val(),
                                            select_modelo: $('#select_modelo').val(),
                                            select_marca: $('#select_marca').val(),
                                            select_tipo_vehiculo: $('#select_tipo_vehiculo').val(),
                                            select_color: $('#select_color').val(),
                                        }

                                        $.post("php/editar_veh.php", postData,
                                            function (response) {
                                                alert(response)
                                            }
                                        );

                                    });
                                }
                                
                            );


                        });

                    }

                }
            })
            .fail(function () {
                alert("Ups, algo ha fallado!")
            })
    }

    function selectModelo(data) {
        let tipoDeSelect = data

        $.post("php/getselect.php", {tipoDeSelect},
            function (response) {
                const respuesta = JSON.parse(response)
                let template = '<option value="0" selected>Abra el menú</option>'

                switch(tipoDeSelect){
                    case "modelo": 

                        respuesta.forEach(element => {
                            template += `<option value="${element.id_modelo}">${element.nom_modelo}</option>`
                        });

                        $('#select_modelo').html(template);
                        break
                    case "marca":

                        respuesta.forEach(element => {
                            template += `<option value="${element.id_marca}">${element.nom_marca}</option>`
                        });

                        $('#select_marca').html(template);
                        break
                    case "tipo_vehiculo":
                        respuesta.forEach(element => {
                            template += `<option value="${element.id_tipo_vehiculo}">${element.nom_tipo_vehiculo}</option>`
                        });

                        $('#select_tipo_vehiculo').html(template);
                        break
                    case "color":
                        respuesta.forEach(element => {
                            template += `<option value="${element.id_color}">${element.nom_color}</option>`
                        });
    
                        $('#select_color').html(template);
                        break
                    
                }

            }
        );
    }

    function actualizarImagen(file1, form, placaVeh) {

        let file = $(`#${file1}`)
        var archivo = file[0].files;
        let placa = placaVeh
        var form_data = new FormData(document.getElementById(`${form}`))
        form_data.append('archivo[]', archivo);
        form_data.append('placa', placa)

        jQuery.ajax({
            url: 'php/actualizar.php',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                alert(data);
                datosVehiculo()
            }
        });

    }

});