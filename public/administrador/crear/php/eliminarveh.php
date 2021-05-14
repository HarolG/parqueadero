<?php

require '../../../../php/conexion.php';

if(isset($_POST['placaVehiculo'])) {
    $placa = $_POST['placaVehiculo'];

    $sql = "DELETE FROM vehiculo WHERE vehiculo.placa = '$placa'";
    $query = mysqli_query($mysqli, $sql);

    if($query) {
        echo "Se ha eliminado correctamente";
    } else {
        echo "Ha ocurrido un error al eliminar";
    }

}

?>