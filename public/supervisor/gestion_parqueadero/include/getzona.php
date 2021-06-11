<?php

    include("../../../../php/conexion.php");

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

        $sql = "SELECT * FROM detalle_cupos, estado_cupo WHERE detalle_cupos.id_estado_cupo = estado_cupo.id_estado_cupo AND id_zona = '$id_zona' AND estado_cupo.nom_estado_cupo = 'Disponible'";
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