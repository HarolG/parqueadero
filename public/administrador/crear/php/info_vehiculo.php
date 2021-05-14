<?php

include_once("../../../../php/conexion.php");


if(isset($_POST['placaVehiculo'])) {
    $placa_vehiculo = $_POST['placaVehiculo'];

    $sql = "SELECT vehiculo.placa, modelo.nom_modelo AS 'modelo', marca.nom_marca AS 'marca', tipo_vehiculo.nom_tipo_vehiculo AS 'tipo_vehiculo', vehiculo.documento, vehiculo.soat, vehiculo.tecnomecanica, vehiculo.foto, color.nom_color AS 'color', vehiculo.anotaciones FROM vehiculo, modelo, marca, tipo_vehiculo, color WHERE vehiculo.placa = '$placa_vehiculo' AND vehiculo.id_modelo = modelo.id_modelo AND vehiculo.id_marca = marca.id_marca AND tipo_vehiculo.id_tipo_vehiculo = vehiculo.id_tip_vehiculo AND vehiculo.id_color = color.id_color";

    $query = mysqli_query($mysqli, $sql);

    while($row = mysqli_fetch_array($query)) {
        $json[] = array(
            'placa' => $row['placa'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'documento' => $row['documento'],
            'tipo_vehiculo' => $row['tipo_vehiculo'],
            'soat' => $row['soat'],
            'tecnomecanica' => $row['tecnomecanica'],
            'foto' => $row['foto'],
            'color' => $row['color'],
            'anotaciones' => $row['anotaciones']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}
?>