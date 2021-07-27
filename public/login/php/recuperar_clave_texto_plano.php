<?php 
include("../../../php/conexion.php");
$correo = $_POST['correo'];
$c = "SELECT clave, IFNULL( NOMBRE, 'nombre' ) as NOMBRE FROM usuario WHERE correo='$correo' LIMIT 1";
$f = mysqli_query( $mysqli , $c );
$a = mysqli_fetch_assoc($f);
if( ! $a ){
	$_SESSION['error'] = 'Usuario inexistente';
	header( "Location: ../recuperar_usuario/recuperar.php" );
	die( );
}
//mas acciones

$mensaje = <<<correo
<p>Hola $a[NOMBRE]</p>
<p>Has solicitado recuperar tu contraseña, la misma era: <code style='background: lightyellow; color: darkred; padding: 1px 2px;'>$a[CLAVE]</code></p>
<p>Si tu no has hecho esta solicitud, ingora el presente mensaje</p>
correo;

echo $mensaje;

//enviar ese mail 
//redireccionar al formulario....




?>