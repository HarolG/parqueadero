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

    $('#formSalida').submit(function (e) { 
        e.preventDefault();
        
        const postData = {
            id_zona: $("#salida_idZona").val(),
            placa: $('#salida_placa').val(),
            nombre_cupo: $('#salida_cupo').val(),
            nom_estado_cupo: $('#salida_nomEstadoCupo').val(),
            nom_tip_zona: $('#salida_nomTipZona').val(),
            salida_deta_cupos: $('#salida_deta_cupos').val() 
        }

        if(postData.nom_estado_cupo == "Disponible") {
            alert("Acción imposible, el cupo se encuentra disponible")
        } else {
            $.post("include/form_salida.php", postData,
                function (response) {
                    alert(response)
                }
            );
        }

        console.log(postData)

    });

    function getCupo() {
        const postData = {
            tipoZona: $('#search_tipo_zona').val(),
            zona: $('#search_zona').val()
        }

        $.post("include/getcupos.php", postData,
            function (response) {

                if (response != "La zona no tiene cupos creados") {
                    const respuesta = JSON.parse(response)
                    let template = ''
                    let template2 = ''

                    respuesta.forEach(element => {
                        template += `
                                        
                                        <form class="formSalidaCupo" method="post">
                                            <input type="hidden" name="inputDetaCupos" value="${element.id_deta_cupos}" class="inputDetaCupos">
                                            <button type="submit" class="cupo cupo_${element.estado_cupo}">
                                                <p class="prueba" aux="">${element.nombre_cupo}</p>
                                            </button>    
                                        </form>                                   
                                    `
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