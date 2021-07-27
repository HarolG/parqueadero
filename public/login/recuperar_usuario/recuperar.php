<?php 
include("../../../php/conexion.php");
include_once("PHPMailer/correo.php");

if( isset( $_SESSION['error'] ) ){
	$class = 'error';
	$mensaje = $_SESSION['error'];
	unset( $_SESSION['error'] );
}else if( isset( $_SESSION['rta'] ) ){
	$class = 'ok';
	$mensaje = $_SESSION['rta'];
}else{
	$class = 'info';
	$mensaje = 'Ingresa tu correo y te haremos recuperar la clave de acceso al blog';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="icon" href="../../../img/logo.ico"/>
    <link rel="stylesheet" href="css/recuperar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="recupera_container">
            <div class="recupera_container-left">
                <video autoplay muted loop>
                    <source src="../../../img/videos/Parking_system.mp4" type="video/mp4">
                </video>
            </div>
            <div class="recupera_container-right">
                <form action="" class="form_recuperar" method="POST">
                    <div class="container_form">
                        <h2>RECUPERACIÓN DE USUARIO Y/O CONTRASEÑA</h2> <br>

                        <p>Haz perdido tu usuario o contraseña para recuperarlo ingresa el correo electronico con el cual estas registrado</p>
                        <div class="grupo grupo_datos-recupera">
                            <label for="">Correo electronico</label>
                            <input type="text" name="correo" id="correo" placeholder="" required autocomplete="off">
                        </div>
                        <div class="grupo grupo_boton-recupera">
                            <input type="submit" name="enviar" class="btnInicio" value="RECUPERAR">
                            <small>¿Quieres ingresar? <a href="../login.html">Iniciar sesion</a></small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
if(isset($_POST['enviar'])) {
    $correo = $_POST['correo'];

    $c = "SELECT documento, IFNULL( NOMBRE, 'nombre' ) as NOMBRE FROM usuario WHERE correo='$correo' LIMIT 1";
    $f = mysqli_query( $mysqli , $c );
    $a = mysqli_fetch_assoc($f);
    if( ! $a ){
        $_SESSION['error'] = 'Correo inexistente';

        echo '<script type="text/javascript">
            alert("Lo sentimos, el correo que ha ingresado no se encuentra registrado en el sistema, por favor verifique e intente nuevamente");
			window.location.href="../recuperar_usuario/recuperar.php";
            </script>';
        die( );
    }

    //generar una clave aleatoria 
    $clave_nueva = rand( 10000000, 99999999 );
    $nombreUsu = $a['nombre'];
    $docu = $a['documento'];

    //enviar correo con la nuea clave 
    correo($correo, $nombreUsu, $clave_nueva);

    //actualizar clave
    $cambioPass = $mysqli -> query ("UPDATE usuario SET clave = '$clave_nueva' WHERE usuario.documento = '$docu'");


}

?>