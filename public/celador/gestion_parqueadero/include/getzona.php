<?php

    include("../../../../php/conexion.php");

    if(isset($_POST['placa'])) {
        $placa = $_POST['placa'];
        
        $sql = "SELECT * FROM `detalle_vehiculo` WHERE `placa` = '$placa'";
        $query = mysqli_query($mysqli, $sql);

        while($row = mysqli_fetch_array($query)) {
            $json[] = array(
                'documento' => $row['documento'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }

    if(isset($_POST['id_tipo_zona'])) {
        $id_tipo_zona = $_POST['id_tipo_zona'];

        $sql = "SELECT * FROM `zona_parqueo` WHERE `id_tip_zona` = '$id_tipo_zona'";
        $query = mysqli_query($mysqli, $sql);

        while($row = mysqli_fetch_array($query)) {
            $json[] = array(
                'id_zona' => $row['id_zona'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }
    
    if(isset($_POST['id_zona'])) {
        $id_zona = $_POST['id_zona'];

        $sql = "SELECT * FROM detalle_cupos, estado WHERE detalle_cupos.id_estado = estado.id_estado AND id_zona = '$id_zona' AND estado.nom_estado = 'Disponible'";
        $query = mysqli_query($mysqli, $sql);

        while($row = mysqli_fetch_array($query)) {
            $json[] = array(
                'id_deta_cupos' => $row['id_deta_cupos'],
                'id_zona' => $row['id_zona'],
                'nombre_cupo' => $row['nombre_cupo'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }

?>