<?php

    include("../../../php/conexion.php");

    if (isset($_POST['enviar'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $consul = "SELECT * FROM usuario WHERE documento = '$user' AND clave = '$pass'";
        $query = mysqli_query($mysqli, $consul);
        $fila = mysqli_fetch_assoc($query);

        if ($fila) {
            $_SESSION['tipo'] = $fila['id_tip_usu'];
            $_SESSION['nom'] = $fila['nombre'];
            $_SESSION['ape'] = $fila['apellido'];
            $_SESSION['pass'] = $fila['clave'];

            if ($_SESSION['pass'] == $pass) {
                header("Location: ../../administrador/administrador.php");
                // echo 'ta bien';
            } else {
                echo 'este usuario es invalido';
            }
        }
    } else {
        echo 'hay un error';
    }

?>