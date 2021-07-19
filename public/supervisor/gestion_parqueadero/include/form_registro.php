<?php

    if(isset($_POST['placa']) && isset($_POST['documento']) && isset($_POST['select_tipo_zona']) && isset($_POST['select_zona']) && isset($_POST['select_cupo'])) {
        
        if($_POST['placa'] != "" && $_POST['documento'] != "" && $_POST['select_tipo_zona'] != "" && $_POST['select_zona'] != "" && $_POST['select_cupo'] != "") {

            include("../../../../php/conexion.php");
            
            $placa = $_POST['placa'];
            $id_deta_vehiculo = $_POST['documento'];
            $select_tipo_zona = $_POST['select_tipo_zona'];
            $select_zona = $_POST['select_zona'];
            $select_cupo = $_POST['select_cupo'];

            // $sql3 = "SELECT * FROM `detalle_vehiculo` WHERE `documento` = '$documento' AND `placa` = '$placa'";
            // $query3 = mysqli_query($mysqli, $sql3);
            // $fila = mysqli_fetch_assoc($query3);

            // $id_deta_vehiculo = $fila['id_deta_vehiculo'];

            $sql = "INSERT INTO registro_parqueadero (id_registro, id_deta_vehiculo, fecha, hora, hora_salida, id_zona, id_estado) VALUES (NULL, '$id_deta_vehiculo', CURRENT_DATE(), CURRENT_TIME(), NULL,'$select_zona', '6')";
            $query = mysqli_query($mysqli, $sql);

            $sql2 = "UPDATE detalle_cupos SET id_deta_vehiculo = '$id_deta_vehiculo', id_estado = '5' WHERE id_zona = '$select_zona' AND id_deta_cupos = '$select_cupo'";
            $query2 = mysqli_query($mysqli, $sql2);

            if($query2 && $query) {
                echo "El vehiculo con placas $placa ha sido parqueado en la zona $select_zona con el cupo $select_cupo";
            } else {
                echo "Ups! algo ha fallado";
            }
            

        } else {
            echo "Los campos del formulario no pueden estar vacios";
        }

    } else {
        echo "Ups! algo ha fallado";
    }

?>