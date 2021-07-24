<?php
    include ("../../../php/conexion.php");


    $documento=$_POST["documento"];
    $opcion =$_POST["opcion"];
    $informacion = [];

    switch ($opcion) {

        case 'eliminar':
            eliminar($documento, $conexion);
            break;
    }

    function eliminar($documento, $conexion){
        $query = "DELETE FROM usuario WHERE documento = $documento";
        $resultado = mysqli_query($conexion, $query);
        verificar_resultado( $resultado );
        cerrar( $conexion );
    }

    function verificar_resultado($resultado){
        if (!$resultado) $informacion["respuesta"]="ERROR!";
        else $informacion["respuesta"]="BIEN!";
        echo json_encode($informacion);
    }

    function cerrar($conexion){
        mysqli_close($conexion);
    }
?>