<?php

    include("../../../../php/conexion.php");

    if(isset($_POST['placa'])) {
        $placa = $_POST['placa'];
        
        $sql = "SELECT * FROM usuario, detalle_vehiculo WHERE usuario.documento = detalle_vehiculo.documento AND detalle_vehiculo.placa = '$placa'";
        $query = mysqli_query($mysqli, $sql);

        while($row = mysqli_fetch_array($query)) {
            $json[] = array(
                'documento' => $row['documento'],
                'id_deta_vehiculo' => $row['id_deta_vehiculo'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }

    if(isset($_POST['placaZonas'])) {
        $sqlTipoVehiculo = "SELECT * FROM vehiculo WHERE placa = 'TST123'";
        $queryTipovehiculo = mysqli_query($mysqli, $sqlTipoVehiculo);
        
    
        if($queryTipovehiculo) {
            $filaTipoVehiculo = mysqli_fetch_assoc($queryTipovehiculo);
    
            $tipoVehiculo = $filaTipoVehiculo['id_tip_vehiculo'];
    
            $sqlZonaDisponible = "SELECT * FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona AND tipo_zona.id_tip_zona = 1";
            $queryZonaDisponible = mysqli_query($mysqli, $sqlZonaDisponible);
            
            while($row = mysqli_fetch_array($queryZonaDisponible)) {
                $json[] = array(
                    'id_zona' => $row['id_zona'],
                    'nom_tip_zona' => $row['nom_tip_zona'],
                );
            }
    
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
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

        $sql = "SELECT * FROM detalle_cupos, estado WHERE detalle_cupos.id_estado = estado.id_estado AND id_zona = '$id_zona' AND estado.id_estado = 4";
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