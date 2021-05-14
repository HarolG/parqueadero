<?php

    $dir_subida = '../archivos/';
    $placa = $_POST['placa'];

    if(isset($_FILES['imagenVehiculo'])) {
        $archivo = 'imagenVehiculo';
        $tipo = 'foto';
        cambiarImagen($archivo, $tipo, $dir_subida, $placa);
    }

    if(isset($_FILES['foto_soat'])) {
        $archivo = 'foto_soat';
        $tipo = 'soat';
        cambiarImagen($archivo, $tipo, $dir_subida, $placa);
    }

    if(isset($_FILES['foto_tecno'])) {
        $archivo = 'foto_tecno';
        $tipo = 'tecnomecanica';
        cambiarImagen($archivo, $tipo, $dir_subida, $placa);
    }

    function cambiarImagen($archivo, $tipo, $dir_subida, $placa) {

        require '../../../../php/conexion.php';
        $dir_imagen_subida = $dir_subida . basename($_FILES[$archivo]['name']);

        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $dir_imagen_subida)) {

            $dir_subida = 'archivos/';
            $dir_imagen_subida = $dir_subida . basename($_FILES[$archivo]['name']);

            $sql = "UPDATE vehiculo SET $tipo = '$dir_imagen_subida' WHERE vehiculo.placa = '$placa'";
            $query = mysqli_query($mysqli, $sql);

            if($query) {
                echo "El/La $tipo ha sido actualizada correctamente";
            } else {
                echo "Ha sucedido un error al actualizar El/la $tipo";
            }

        }
    }

?>