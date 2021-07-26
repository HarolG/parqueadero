<?php

include_once("../../../../php/conexion.php");

$sql = "SELECT * FROM zona_parqueo";
$query = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($query)) {
    $json[] = array(
        'id_zona' => $row['id_zona'],
        'id_tip_zona' => $row['id_tip_zona'],
        'id_estado|' => $row['id_estado'],
    );
}

foreach ($json as $zonas) {
    
    $id_zona = $zonas['id_zona'];

    $sql2 = "SELECT * FROM detalle_cupos WHERE id_zona = $id_zona AND id_estado = 4";
    $query2 = mysqli_query($mysqli, $sql2);
    $cupos_disponibles = mysqli_num_rows($query2);

    if($cupos_disponibles > 0) { 
        echo "Cupos disponibles";
    } else {
        $sql3 = "UPDATE zona_parqueo SET id_estado = '2' WHERE zona_parqueo.id_zona = $id_zona";
        $query3 = mysqli_query($mysqli, $sql3);
    }

}

?>