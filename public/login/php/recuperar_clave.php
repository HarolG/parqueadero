<?php 
include("../../../php/conexion.php");
$correo = $_POST['correo'];
$c = "SELECT documento, IFNULL( NOMBRE, 'nombre' ) as NOMBRE FROM usuario WHERE correo='$correo' LIMIT 1";
$f = mysqli_query( $mysqli , $c );
$a = mysqli_fetch_assoc($f);
if( ! $a ){
	$_SESSION['error'] = 'Correo inexistente';
	header( "Location: ../recuperar_usuario/recuperar.php" );
	die( );
}
//generar una clave aleatoria y el token

$token = $a['documento'] . time( ) . rand( 1000, 9999 );
$clave_nueva = rand( 1000, 9999 );
$idusuario = $a['documento'];

$c2 = "INSERT INTO recuperar SET correo='$correo', token='$token', fecha=NOW( ), clave_nueva='$clave_nueva' ON DUPLICATE KEY UPDATE token='$token', clave_nueva='$clave_nueva'";
mysqli_query($mysqli, $c2);

$link = "recuperar_clave_confirmar.php?correo=$correo&token=$token";

//envío de mail
$mensaje = <<<EMAIL
<p>Hola $a[NOMBRE]</p>
<p>Has solicitado recuperar tu contraseña, el sistema te ha generado una nueva clave que es: <code style='background: lightyellow; color: darkred; padding: 1px 2px;'>$clave_nueva</code></p>
<p>Pero antes de poder usarla, deberás hacer <a href='$link'>click en este vínculo</a> o copiar este código en la URL de tu navegador</p>
<code style='background: black; color: white; padding: 4px;'>$link</code>
<p>Si tu no has hecho esta solicitud, ingora el presente mensaje</p>
EMAIL;

echo $mensaje;

//enviar ese mail 
//redireccionar al formulario....




?>