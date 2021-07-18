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
            $nom = $fila['nombre'];
            $ape = $fila['apellido'];
            $tip = $fila['id_tip_usu'];
            $estadousu = $fila['id_estado'];

            if ($_SESSION['tipo'] == 1) {
                header("Location: ../../administrador/home/administrador.php");
            } elseif ($_SESSION['tipo'] == 2) {

                if ($_SESSION['tipo'] == 2 && $estadousu == 6) {
                    
                    $sqli = "INSERT INTO informe_celadores (documento, nombre, apellido, id_tip_usu, fecha_inicio) VALUES ('$user', '$nom', '$ape', '$tip', now())";
                    $quer = mysqli_query($mysqli, $sqli);
    
                    header("Location: ../../celador/home/home.php");
                } else if ($_SESSION['tipo'] == 2 && $estadousu == 7) {
                    echo '<script type="text/javascript">
                            alert("Este usuario esta inhabilitado");
                            window.location.href="../login.html";
                        </script>';
                } else if ($_SESSION['tipo'] == 2 && $estadousu == 8) {
                    echo '<script type="text/javascript">
                            alert("Este usuario esta con una incapacidad");
                            window.location.href="../login.html";
                        </script>';
                }
                
            } elseif ($_SESSION['tipo'] == 3) {
                header("Location: ../../supervisor/home/home.php");
            }

            // if ($_SESSION['pass'] == $pass) {
            //     header("Location: ../../administrador/home/administrador.php");
            //     // echo 'ta bien';
            // } else {
            //     echo 'este usuario es invalido';
            // }
        } else {
            echo '<script type="text/javascript">
                    alert("Este usuario no existe");
                    window.location.href="../login.html";
                </script>';
        }
    } else {
        echo 'hay un error';
    }

?>