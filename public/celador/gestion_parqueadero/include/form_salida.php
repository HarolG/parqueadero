<?php

    if(isset($_POST['nom_estado_cupo'])) {
        include("../../../../php/conexion.php");

        $id_zona = $_POST['id_zona'];
        $placa = $_POST['placa'];
        $documento = $_POST['documento'];
        $nombre_cupo = $_POST['nombre_cupo'];
        $nom_estado_cupo = $_POST['nom_estado_cupo'];
        $nom_tip_zona = $_POST['nom_tip_zona'];
        $salida_deta_cupos = $_POST['salida_deta_cupos'];

        $sql = "UPDATE detalle_cupos SET id_deta_vehiculo = NULL, id_estado = '4' WHERE detalle_cupos.id_deta_cupos = '$salida_deta_cupos'";
        $query = mysqli_query($mysqli, $sql);
         
        $sql2 = "SELECT * FROM registro_parqueadero, detalle_vehiculo WHERE detalle_vehiculo.id_deta_vehiculo = registro_parqueadero.id_deta_vehiculo AND placa = '$placa' AND documento = '$documento' AND registro_parqueadero.id_estado = 6";
        $query2 = mysqli_query($mysqli, $sql2);
        $resultado2 = mysqli_fetch_assoc($query2);

        $id_registro = $resultado2['id_registro'];

        $sql3 = "UPDATE registro_parqueadero SET id_estado = '7', hora_salida = CURRENT_TIME() WHERE registro_parqueadero.id_registro = '$id_registro'";
        $query3 = mysqli_query($mysqli, $sql3);

        $sql4 = "UPDATE `detalle_vehiculo` SET `id_estado` = '4' WHERE placa = '$placa' AND documento = '$documento' AND id_estado = 5";
        $query4 = mysqli_query($mysqli, $sql4);

        if($query) {
            if($query2) {
                if($query3) {
                    if($query4) {
                        echo "Se ha registrado correctamente la salida";
                    } else {
                        echo "Ups! ha ocurrido un error.";
                    }
                } else {
                    echo "Ups! ha ocurrido un error.";
                }
            } else {
                echo "Ups! ha ocurrido un error.";
            }
        } else {
            echo "Ups! ha ocurrido un error.";
        }

    } else {
        echo "Ups! ha ocurrido un error.";
    }

?>