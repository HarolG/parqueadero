$(document).ready(function () {

    $('#form_placa').blur(function (e) { 
        $('#select_documento').html('<option selected>Seleccione el documento</option>');

        let placa = $(this).val()

        $.post("include/getzona.php", {placa: placa},
            function (data) {
                const respuesta = JSON.parse(data)
                let template = '<option selected>Seleccione el documento</option>'

                respuesta.forEach(element => {
                    template += `
                                    <option value="${element.documento}">${element.documento}</option>
                                `
                });

                $('#select_documento').html(template);
            }
        );
    });

    $('#select_tipo_zona').change(function (e) {
        $('#select_zona').html('<option selected>Seleccione la zona</option>');
        $('#select_cupo').html('<option selected>Seleccione el cupo</option>');
        
        $("#select_tipo_zona option:selected").each(function () {
            let id_tipo_zona = $(this).val()

            $.post("include/getzona.php", {id_tipo_zona: id_tipo_zona},
                function (data) {
                    const respuesta = JSON.parse(data)
                    let template = '<option selected>Seleccione la zona</option>'

                    respuesta.forEach(element => {
                        template += `
                                        <option value="${element.id_zona}">Zona ${element.id_zona}</option>
                                    `
                    });

                    $('#select_zona').html(template);
                }
            );
        })

    });


    $('#select_zona').change(function (e) { 
        $('#select_cupo').html('<option selected>Seleccione el cupo</option>');
        
        $("#select_zona option:selected").each(function () {
            let id_zona = $(this).val()

            $.post("include/getzona.php", {id_zona: id_zona},
                function (data) {
                    const respuesta = JSON.parse(data)
                    let template = '<option selected>Seleccione el cupo</option>'

                    respuesta.forEach(element => {
                        template += `
                                        <option value="${element.id_deta_cupos}">${element.nombre_cupo}</option>
                                    `
                    });

                    $('#select_cupo').html(template);
                }
            );
        })
        
    });

    $('#search_tipo_zona').change(function (e) {
        $('#search_zona').html('<option selected>Abre el menú</option>');
        
        $("#search_tipo_zona option:selected").each(function () {
            let id_tipo_zona = $(this).val()

            $.post("include/getzona.php", {id_tipo_zona: id_tipo_zona},
                function (data) {
                    const respuesta = JSON.parse(data)
                    let template = '<option selected>Abre el menú</option>'

                    respuesta.forEach(element => {
                        template += `
                                        <option value="${element.id_zona}">Zona ${element.id_zona}</option>
                                    `
                    });

                    $('#search_zona').html(template);
                }
            );
        })

    });

});