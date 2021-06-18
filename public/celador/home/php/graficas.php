<?php

include_once("../../../../php/conexion.php");

if(isset($_POST['idZona'])) {
    $id_zona = $_POST['idZona'];

    #Esta consulta trae toda la información de la zona de parqueo
    $sql = "SELECT zona_parqueo.id_zona, tipo_zona.nom_tip_zona, estado.nom_estado FROM zona_parqueo, tipo_zona, estado WHERE zona_parqueo.id_zona = '$id_zona' AND zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona AND zona_parqueo.id_estado = estado.id_estado";

    $query_informacion = mysqli_query($mysqli, $sql);
    $fila_informacion = mysqli_fetch_assoc($query_informacion);

    #Esta consulta trae todos los cupos disponibles de la zona
    $sql2 = "SELECT * FROM detalle_cupos WHERE id_zona = '$id_zona' AND id_estado_cupo = '1'";
    $query_cupos_disponibles = mysqli_query($mysqli, $sql2);

    #Cuento el número de cupos disponibles que hay
    $cupos_disponibles = mysqli_num_rows($query_cupos_disponibles);

    #Esta consulta trae todos los cupos ocupados de la zona
    $sql3 = "SELECT * FROM detalle_cupos WHERE id_zona = '$id_zona' AND id_estado_cupo = '2'";
    $query_cupos_ocupados = mysqli_query($mysqli, $sql3);

    #Cuento el número de cupos ocupados que hay
    $cupos_ocupados = mysqli_num_rows($query_cupos_ocupados);

    $json[] = array(
        'id_zona' => $fila_informacion['id_zona'],
        'nom_tip_zona' => $fila_informacion['nom_tip_zona'],
        'nom_estado' => $fila_informacion['nom_estado'],
        'cupos_disponibles' => $cupos_disponibles,
        'cupos_ocupados' => $cupos_ocupados,
        'cupos_totales' => $cupos_disponibles + $cupos_ocupados
    );

    $jsonstring = json_encode($json);
    echo $jsonstring;

}

?>