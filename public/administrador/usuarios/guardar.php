<?php
    include ("../../../php/conexion.php");


    $documento=$_POST["documento"];
    $edad = $_POST["edad"];
    $celular = $_POST["celular"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];
    $opcion =$_POST["opcion"];
    $informacion = [];

    switch ($opcion) {
        case 'modificar':
            modificar($edad, $celular, $direccion, $correo, $documento, $conexion);
            break;
        
        case 'eliminar':
            eliminar($documento, $conexion);
            break;
    }


    function modificar($edad, $celular, $direccion, $correo, $documento, $conexion){ 
        $query= "UPDATE usuario SET edad='$edad',
                                    celular='$celular',
                                    direccion='$direccion',
                                    correo='$correo' 
                                WHERE documento = '$documento'";
        $resultado = mysqli_query($conexion, $query);
        verificar_resultado( $resultado );
        cerrar( $conexion );
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