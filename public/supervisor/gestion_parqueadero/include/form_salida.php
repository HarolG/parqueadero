<?php

    if(isset($_POST['nom_estado_cupo'])) {
        include("../../../../php/conexion.php");

        $id_zona = $_POST['id_zona'];
        $placa = $_POST['placa'];
        $nombre_cupo = $_POST['nombre_cupo'];
        $nom_estado_cupo = $_POST['nom_estado_cupo'];
        $nom_tip_zona = $_POST['nom_tip_zona'];
        $salida_deta_cupos = $_POST['salida_deta_cupos'];

        $sql = "UPDATE detalle_cupos SET placa = NULL, id_estado_cupo = '2' WHERE detalle_cupos.id_deta_cupos = $salida_deta_cupos";
        $query = mysqli_query($mysqli, $sql);
         
        $sql2 = "SELECT * FROM registro_parqueadero WHERE placa = '$placa' AND id_estado_registro = 1";
        $query2 = mysqli_query($mysqli, $sql2);
        $resultado2 = mysqli_fetch_assoc($query2);

        $id_registro = $resultado2['id_registro'];

        $sql3 = "UPDATE registro_parqueadero SET placa = '$placa', id_estado_registro = '2' WHERE registro_parqueadero.id_registro = '$id_registro'";
        $query3 = mysqli_query($mysqli, $sql3);

        if($query) {
            echo "Se ha registrado correctamente la salida";
        } else {
            echo "Ups! ha ocurrido un error.";
        }

    } else {
        echo "Ups! ha ocurrido un error.";
    }

?>