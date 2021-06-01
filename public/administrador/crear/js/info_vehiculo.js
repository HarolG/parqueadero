$(document).ready(function () {

    const formSearch = $('#form_info_vehiculo')

    $(formSearch).submit(function (e) {
        e.preventDefault();

        const placaVehiculo = $('#search_vehiculo')

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
                            $('html, body').css({
                                'overflow': 'auto',
                                'height': 'auto'
                            });
                    
                            $('#container_modal').css({
                                'display': 'none'
                            })
                        });

                    }

                }
            })
            .fail(function () {
                alert("Ups, algo ha fallado!")
            })
    });

    function datosPropietario() {
        $('html, body').css({
            'overflow': 'hidden',
            'height': '100%'
        });

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
    }

});