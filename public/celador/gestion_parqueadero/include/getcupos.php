<?php

    if(isset($_POST['tipoZona']) && isset($_POST['zona'])) {

        include("../../../../php/conexion.php");

        $tipo_zona = $_POST['tipoZona'];
        $zona = $_POST['zona'];

        $sql = "SELECT * FROM detalle_cupos, estado WHERE detalle_cupos.id_estado = estado.id_estado AND id_zona = '$zona' ORDER BY nombre_cupo ASC";
        $query = mysqli_query($mysqli, $sql);
        $rowcount= mysqli_num_rows($query);

        if($rowcount > 0) {

            #Cambiar aquí
            while($row = mysqli_fetch_array($query)) {
                $json[] = array(
                    'id_deta_cupos' => $row['id_deta_cupos'],
                    'id_zona' => $row['id_zona'],
                    'nombre_cupo' => $row['nombre_cupo'],
                    'estado_cupo' => $row['nom_estado'],
                    'placa' => $row['id_deta_vehiculo']
                );
            }
    
            $jsonstring = json_encode($json);
            echo $jsonstring;

        } else {
            echo 'La zona no tiene cupos creados';
        }

    }
?>