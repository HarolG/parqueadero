<?php

require '../../../../php/conexion.php';

if(isset($_POST['documento'])) {
    $documento = $_POST['documento'];
    
    $sql = "SELECT * FROM usuario WHERE documento = '1234'";
    $query = mysqli_query($mysqli, $sql);

    while($row = mysqli_fetch_array($query)) {
        $json[] = array(
            'documento' => $row['documento'],
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'edad' => $row['edad'],
            'celular' => $row['celular'],
            'direccion' => $row['direccion'],
            'correo' => $row['correo']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}

?>