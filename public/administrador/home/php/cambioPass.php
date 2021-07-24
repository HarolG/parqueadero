<?php
    include_once("../../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
		
		$docu = $_SESSION['doc'];
?>     
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/administrador.css">
</head>
<body id="cambiarPass">

    <script> 
    Cambiar();
    function Cambiar(){
        Swal.fire({
            icon: "info",
            title: "CAMBIO DE CONTRASEÑA",
            html:`
                <p class='parrafoPass'>Hola Administrador, por cuestiones de seguridad, Parking System solicita el cambio de contraseña para acceder por primera vez a tu cuenta.</p>
                <form method='POST' class='formPass'>
                    <div>
                        <label for='clave'>Nueva Contraseña:</label>
                        <input type='password' name='clave' required autocomplete='off'>
                    </div>
                    <div>
                        <label for='claveDos'>Confirmar Contraseña:</label>
                        <input type='password' name='claveDos' required autocomplete='off'>
                    </div>
                    <input type='submit' name='actualizarPass' class='btnCambiar' value='Guardar'>
                </form><br>`,
            showConfirmButton: false,
        })
    }
    </script>

    <?php 

      if(isset($_POST['actualizarPass'])){

        $clave = $_POST['clave'];
        $claveDos = $_POST['claveDos'];

        if( $clave == $claveDos){

            $cambioPass = $mysqli -> query ("UPDATE usuario SET clave = '$clave' WHERE usuario.documento = '$docu'");
            $cambioEstadoPass = $mysqli -> query ("UPDATE usuario SET id_estado = 9 WHERE usuario.documento = '$docu'");
        ?>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Cambio de contraseña exitoso",
                    footer: '<div class="btnCambiarDos"><a href="../../../login/login.html">INICIAR SESION</a></div>',
                    text: "Por favor inicie sesión nuevamente con su contraseña nueva.",
                    showConfirmButton: false
                  })
            </script>
        <?php 
        }else{
        ?>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "ERROR",
                    footer: '<button class="btnCambiar" onclick="Cambiar()">Volver a Intentar</button>&nbsp;<a href="../../../login/login.html" class="btnCambiarDos">Ir al Inicio</a>',
                    text: "Contraseñas no coinciden, por favor intente nuevamente.",
                    showConfirmButton: false
                  })
            </script>
            <?php 
            }
          }
          ?>
</body>

</html>

<?php

} 
else {
    echo '<script type="text/javascript">window.location.href="../../../login/login.html";</script>';
}
?>
