$(document).ready(function () {
    
    $('#form_search_cupo').submit(function (e) { 
        e.preventDefault();
        getCupo()
    });

    $('#form_registro').submit(function (e) { 
        e.preventDefault();
        
        const postData = {
            placa: $('#form_placa').val().toUpperCase(),
            select_tipo_zona: $('#select_tipo_zona').val(),
            select_zona: $('#select_zona').val(),
            select_cupo: $('#select_cupo').val()
        }

        $.post("include/form_registro.php", postData,
            function (response) {
                getCupo()
                alert(response)
            }
        );

    });

    function getCupo() {
        const postData = {
            tipoZona : $('#search_tipo_zona').val(),
            zona : $('#search_zona').val()
        }

        $.post("include/getcupos.php", postData,
            function (response) {

                if(response != "La zona no tiene cupos creados") {
                    const respuesta = JSON.parse(response)
                    let template = ''
                    let template2 = ''

                    respuesta.forEach(element => {
                        template += `
                                        <div class="cupo cupo_${element.estado_cupo}">
                                            <p class="prueba" aux="${element.id_deta_cupos}">${element.nombre_cupo}</p>
                                        </div>                                    `
                    });

                    $('#cine_container-cupos').html(template);

                } else {
                    alert(response)
                    $('#cine_container-cupos').html('');
                }

            }
        );
    }

});