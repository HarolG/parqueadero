<?php

include_once("../../../../php/conexion.php");

if(isset($_POST['idZona'])) {
    $id_zona = $_POST['idZona'];

    $sql = "SELECT zona_parqueo.id_zona, tipo_zona.nom_tip_zona, estado.nom_estado, zona_parqueo.cupos, zona_parqueo.cupos_live FROM zona_parqueo, tipo_zona, estado WHERE zona_parqueo.id_zona = '$id_zona' AND zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona AND zona_parqueo.id_estado = estado.id_estado";
    $query = mysqli_query($mysqli, $sql);

    while($row = mysqli_fetch_array($query)) {
        $json[] = array(
            'id_zona' => $row['id_zona'],
            'nom_tip_zona' => $row['nom_tip_zona'],
            'nom_estado' => $row['nom_estado'],
            'cupos' => $row['cupos'],
            'cupos_live' => $row['cupos_live']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}

?>