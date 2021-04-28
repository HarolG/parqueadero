<?php
 include("../../../../php/conexion.php");

 if(@$_POST['registrar']){
  $placa = $_POST['placa'];
  $tipZo = $_POST['tipoZona'];
  

  $busca = $mysqli -> query ("SELECT * FROM zona_parqueo WHERE id_tip_zona = '$tipZo'");   
  $infoZo = mysqli_fetch_array($busca);
  $zonaPae = $infoZo['id_zona'];

  

  $registrarEntrada = $mysqli->query("INSERT INTO registro_parqueadero (id_registro, id_tip_entrada, placa, fecha, hora, id_zona) VALUES (NULL, 1, '$placa', now(), now(), '$zonaPae')");


  if ($registrarEntrada){

    $cupos_live = $infoZo['cupos_live'];
    $opc = $cupos_live - 1;

    $descontar = $mysqli->query("UPDATE zona_parqueo SET cupos_live = '$opc'  WHERE  id_tip_zona = '$tipZo'");
    echo "<script> alert('Ingreso Exitoso, que tenga buen dia');
    window.location= '../parqueo.php';
    </script>";
    
  }else{
    echo "<script> alert('ERROR, los datos ingresados no existen en la base de datos, por favor verifique la información');
    window.location= '../parqueo.php';
    </script>";
  }

 }

 ?>