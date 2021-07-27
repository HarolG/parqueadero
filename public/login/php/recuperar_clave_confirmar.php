<?php 
include("../../../php/conexion.php");
$correo = $_GET['correo'];
$token = $_GET['token'];

$c = "SELECT clave_nueva FROM recuperar WHERE correo='$correo' AND token='$token' LIMIT 1 ";
$f = mysqli_query( $mysqli, $c );
$a = mysqli_fetch_assoc($f);
if( ! $a ){
	$_SESSION['error'] = 'Solicitud no encontrada';
	header("Location: ../recuperar_usuario/recuperar.php");
	die( );
}

//OBTENEMOS LA CLAVE Y ACTUALIZAMOS AL USUARIO+
$clave = $a['clave_nueva'];
$c2 = "UPDATE usuario SET clave=('$clave'), id_estado = 10  WHERE correo='$correo' LIMIT 1";
mysqli_query($mysqli, $c2);


//ELIMINAR ESTA SOLICITUD DE RECUPERO

$c3 = "DELETE FROM recuperar WHERE correo='$correo' LIMIT 1";
mysqli_query($mysqli, $c3);


$_SESSION['rta'] = 'Contraseña actualizada satisfactoriamente, ya se puede loguear';
header("Location: ../login.html" );


?>