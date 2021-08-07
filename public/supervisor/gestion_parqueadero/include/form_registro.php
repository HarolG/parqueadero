<?php

    if(isset($_POST['placa']) && isset($_POST['documento'])  && isset($_POST['select_zona']) && isset($_POST['select_cupo'])) {
        
        if($_POST['placa'] != "" && $_POST['documento'] != "" && $_POST['select_zona'] != "" && $_POST['select_cupo'] != "") {

            include("../../../../php/conexion.php");
            
            $placa = $_POST['placa'];
            $id_deta_vehiculo = $_POST['documento'];
            $select_zona = $_POST['select_zona'];
            $select_cupo = $_POST['select_cupo'];

            // $sql3 = "SELECT * FROM `detalle_vehiculo` WHERE `documento` = '$documento' AND `placa` = '$placa'";
            // $query3 = mysqli_query($mysqli, $sql3);
            // $fila = mysqli_fetch_assoc($query3);

            // $id_deta_vehiculo = $fila['id_deta_vehiculo'];

            $sql = "INSERT INTO registro_parqueadero (id_registro, id_deta_vehiculo, fecha, hora, hora_salida, id_zona, id_estado, id_deta_cupos) VALUES (NULL, '$id_deta_vehiculo', CURRENT_DATE(), CURRENT_TIME(), NULL,'$select_zona', '6', '$select_cupo')";
            $query = mysqli_query($mysqli, $sql);

            $sql2 = "UPDATE detalle_cupos SET id_deta_vehiculo = '$id_deta_vehiculo', id_estado = '5' WHERE id_zona = '$select_zona' AND id_deta_cupos = '$select_cupo'";
            $query2 = mysqli_query($mysqli, $sql2);

            $sql3 = "UPDATE `detalle_vehiculo` SET `id_estado` = '5' WHERE `detalle_vehiculo`.`id_deta_vehiculo` = $id_deta_vehiculo";
            $query3 = mysqli_query($mysqli, $sql3);

            $sql4 = "SELECT * FROM detalle_cupos WHERE id_deta_cupos = $select_cupo";
            $query4 = mysqli_query($mysqli, $sql4);
            $resultado4 = mysqli_fetch_assoc($query4);

            $nombre_cupo = $resultado4['nombre_cupo'];

            if($query2 && $query && $query3 && $query4) {
                echo "El vehiculo con placas $placa ha sido parqueado en la zona $select_zona con el cupo $nombre_cupo";
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