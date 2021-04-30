<?php
include("../../../php/conexion.php");

if(@$_POST['salida']){

    $placa = $_POST['placa'];
    $zona = $_POST['zona'];
  
    $registrarSalida = $mysqli->query("INSERT INTO registro_parqueadero (id_registro, id_tip_entrada, placa, fecha, hora, id_zona, lugar) VALUES (NULL, 2, '$placa', now(), now(), '$zona', NULL)");
    
    if ($registrarSalida)
        {
            
            echo '<script>alert("Registro de salida EXITOSO")</script> ';
            echo "<script>location.href='../parqueo.php'</script>";
        }
        else{
            echo '<script>alert("error")</script> ';
    echo "<script>location.href='../parqueo.php'</script>";
        }
    
    
    

}
?>
