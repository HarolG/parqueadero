<?php

    require '../../../../php/conexion.php';

    if(isset($_POST['placa'])) {

        $placa = $_POST['placa'];

        $sql = "SELECT * FROM vehiculo WHERE placa = '$placa'";
        $query = mysqli_query($mysqli, $sql);
        $resultado = mysqli_fetch_assoc($query);

        $json[] = array(
            'placa' => $resultado['placa'],
            'id_modelo' => $resultado['id_modelo'],
            'id_marca' => $resultado['id_marca'],
            'id_tip_vehiculo' => $resultado['id_tip_vehiculo'],
            'id_color' => $resultado['id_color']
        );

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }

    if(isset($_POST['editar_placa'])) {

        $editar_placa = $_POST['editar_placa'];
        $select_modelo = $_POST['select_modelo'];
        $select_marca = $_POST['select_marca'];
        $select_tipo_vehiculo = $_POST['select_tipo_vehiculo'];
        $select_color = $_POST['select_color'];

        if($editar_placa == 0 or $select_modelo == 0 or $select_marca == 0 or $select_tipo_vehiculo == 0 or $select_color == 0) {
            echo "Por favor rellene el formulario correctamente";
        } else {
            $sql = "UPDATE vehiculo SET id_modelo = '$select_modelo', id_marca = '$select_marca', id_tip_vehiculo = '$select_tipo_vehiculo', id_color = '$select_color' WHERE vehiculo.placa = '$editar_placa'";
            $query = mysqli_query($mysqli, $sql);

            if($query) {
                echo "El vehiculo ha sido actualizado correctamente";
            } else {
                echo "Ha ocurrido un error a la hora de actualizar";
            }
        }

    }

?>