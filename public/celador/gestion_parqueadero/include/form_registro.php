<?php

    if(isset($_POST['placa']) && isset($_POST['select_tipo_zona']) && isset($_POST['select_zona']) && isset($_POST['select_cupo'])) {
        
        if($_POST['placa'] != "" && $_POST['select_tipo_zona'] != "" && $_POST['select_zona'] != "" && $_POST['select_cupo'] != "") {

            include("../../../../php/conexion.php");
            
            $placa = $_POST['placa'];
            $select_tipo_zona = $_POST['select_tipo_zona'];
            $select_zona = $_POST['select_zona'];
            $select_cupo = $_POST['select_cupo'];

            $sql = "INSERT INTO registro_parqueadero (id_registro, id_tip_entrada, placa, fecha, hora, id_zona, id_estado_registro) VALUES (NULL, '1', '$placa', CURRENT_DATE(), CURRENT_TIME(), '$select_zona', '1')";
            $query = mysqli_query($mysqli, $sql);

            $sql2 = "UPDATE detalle_cupos SET placa = '$placa', id_estado_cupo = '2' WHERE  id_zona = '$select_zona' AND id_deta_cupos = '$select_cupo'";
            $query2 = mysqli_query($mysqli, $sql2);

            if($query2) {
                echo "El vehiculo con placas $placa ha sido parqueado en la zona $select_zona con el cupo $select_cupo";
            } else {
                echo "Ups! algo ha fallado";
            }
            

        } else {
            echo "Los campos del formulario no pueden estar vacios";
        }

    } else {
        echo "Ups! algo ha fallado";
    }

?>