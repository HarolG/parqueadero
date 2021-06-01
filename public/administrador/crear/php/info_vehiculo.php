<?php

include_once("../../../../php/conexion.php");


if(isset($_POST['search_vehiculo'])) {
    $placa = $_POST['search_vehiculo'];

    function getVehiculo($placa_vehiculo, $mysqli) {

        $sql = "SELECT vehiculo.placa, modelo.nom_modelo AS 'modelo', marca.nom_marca AS 'marca', tipo_vehiculo.nom_tipo_vehiculo AS 'tipo_vehiculo', vehiculo.documento, vehiculo.soat, vehiculo.tecnomecanica, vehiculo.foto, color.nom_color AS 'color', vehiculo.anotaciones FROM vehiculo, modelo, marca, tipo_vehiculo, color WHERE vehiculo.placa = '$placa_vehiculo' AND vehiculo.id_modelo = modelo.id_modelo AND vehiculo.id_marca = marca.id_marca AND tipo_vehiculo.id_tipo_vehiculo = vehiculo.id_tip_vehiculo AND vehiculo.id_color = color.id_color";
        $query = mysqli_query($mysqli, $sql);

        if($query) {

            if(mysqli_num_rows($query) != 0) {

                $resultado = mysqli_fetch_assoc($query);

                if($resultado['anotaciones'] != null && $resultado['soat'] != null && $resultado['foto'] != null && $resultado['tecnomecanica'] != null) {
                    $jsonstring = json_encode($resultado);
                    echo $jsonstring;
                } else {
                    array_push($resultado, 'another_info');
                    $jsonstring = json_encode($resultado);
                    echo $jsonstring;
                }
        
            } else {
                throw new Exception('No encontrado');
            }
    }
    
    }

    try {
        echo getVehiculo($placa, $mysqli);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

?>