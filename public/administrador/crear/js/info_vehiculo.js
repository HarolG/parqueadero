$(document).ready(function () {
    const formSearchVehiculo = $('#form_info_vehiculo')

    $(formSearchVehiculo).submit(function (e) {
        e.preventDefault();
        datosVehiculo()
    });

    function datosVehiculo() {

        let placaVehiculo = $('#search_vehiculo').val()
        $.post("php/info_vehiculo.php", {
                placaVehiculo
            },
            function (response) {
                const respuesta = JSON.parse(response)
                let template = '';

                respuesta.forEach(element => {
                    template += `
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
                                        <td id="placaVehiculo">${element.placa}</td>
                                        <td>${element.modelo}</td>
                                        <td>${element.marca}</td>
                                        <td>${element.tipo_vehiculo}</td>
                                        <td class="documento">
                                            <a href="#" id="documentoPropietario">${element.documento}</a>
                                        </td>
                                        <td>${element.color}</td>
                                        <td>
                                            <a href="#" class="edit">Editar</a>
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
                                        <img src="${element.foto}" alt="Foto del vehiculo">
                                        <form enctype="multipart/form-data" id="form_cambiarImagen">
                                            <input type="file" name="imagenVehiculo" id="imagenVehiculo">
                                            <button type="submit" id="prueba">Cambiar Imagen</button>
                                        </form>
                                    </div>
                                    <div class="column_anotherInfo-derecha">
                                        <div class="grupo_anotherInfo">
                                            <p>Soat:</p>
                                            <a href="${element.soat}" target="_blank">Ver Soat</a> 
                                            <form id="form_soat" enctype="multipart/form-data">
                                                <input type="file" name="foto_soat" id="foto_soat">
                                                <button type="submit">Actualizar</button>
                                            </form>
                                        </div>
                                        <div class="grupo_anotherInfo">
                                            <p>Tecnomecánica:</p>
                                            <a href="${element.tecnomecanica}" target="_blank">Ver Tecnomecánica</a>
                                            <form id="form_tecno" enctype="multipart/form-data">
                                                <input type="file" name="foto_tecno" id="foto_tecno">
                                                <button type="submit">Actualizar</button>
                                            </form>
                                        </div>
                                        <div class="grupo_anotherInfo">
                                            <p>Anotaciones:</p>
                                            <small class="texto">${element.anotaciones}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                });

                $('#table_container').html(template);

                $('#documentoPropietario').click(function (e) { 
                    $('html, body').css({
                        'overflow': 'hidden',
                        'height': '100%'
                    });

                    $('#container_modal').css({
                        'display': 'flex'
                    })

                    let documento =  $('#documentoPropietario').text();

                    $.post("php/datos_propietario.php", {documento},
                        function (data) {
                            let respuesta = JSON.parse(data)

                            let template = `
                                                <div class="grupoModal">
                                                    <div>
                                                        <p>Documento:</p>
                                                        <div>${respuesta[0]['documento']}</div>
                                                    </div>
                                                    <div>
                                                        <p>Nombre y Apellido:</p>
                                                        <div>${respuesta[0]['nombre']} ${respuesta[0]['apellido']}</div>
                                                    </div>
                                                    <div>
                                                        <p>Edad:</p>
                                                        <div>${respuesta[0]['edad']} años</div>
                                                    </div>
                                                </div>
                                                <div class="grupoModal">
                                                    <div>
                                                        <p>Celular:</p>
                                                        <div>${respuesta[0]['celular']}</div>
                                                    </div>
                                                    <div>
                                                        <p>Dirección:</p>
                                                        <div>${respuesta[0]['direccion']}</div>
                                                    </div>
                                                    <div>
                                                        <p>Correo:</p>
                                                        <div>${respuesta[0]['correo']}</div>
                                                    </div>
                                                </div>
                            
                                            `
                            
                            $('#container_gruposModales').html(template);
                            
                        }
                    );

                });

                $('#btn_delete').click(function (e) { 
                    e.preventDefault();
                    if(confirm("¿Estás seguro de eliminar este registro?")) {
                        $.post("php/eliminarveh.php", {placaVehiculo},
                            function (response) {
                                alert(response)
                                location.reload();
                            }
                        );
                    }
                });

                $('#form_cambiarImagen').submit(function (e) {
                    e.preventDefault();
                    actualizarImagen("imagenVehiculo", "form_cambiarImagen", placaVehiculo)
                });

                $('#form_soat').submit(function (e) { 
                    e.preventDefault();
                    actualizarImagen("foto_soat", "form_soat", placaVehiculo)
                });

                $('#form_tecno').submit(function (e) { 
                    e.preventDefault();
                    actualizarImagen("foto_tecno", "form_tecno", placaVehiculo)
                });
                
            }
        );

    }

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