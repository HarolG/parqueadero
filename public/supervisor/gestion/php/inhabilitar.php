<?php
 include("../../../../php/conexion.php");
// $cantidad = '';

if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
    
    if  (isset($_GET['documento'])) {
    $id = $_GET['documento'];
    
    $query1 = "SELECT * FROM usuario WHERE documento = $id";
    $resu = mysqli_query($mysqli, $query1);
    $fila = mysqli_fetch_assoc($resu);

    if ($fila) {
        $_SESSION['estado'] = $fila['id_estado'];

        if ($_SESSION['estado'] == 7) {
           echo '<script type="text/javascript">
                    alert("Este usuario ya se encuentra en estado inhabilitado");
                    window.location.href="../index.php";
                </script>';
        } else {
            
            $query = "UPDATE usuario SET id_estado = 7 WHERE documento = $id";
            $result = mysqli_query($mysqli, $query);
            
            if ($result) {
                header("Location: ../index.php");
            }
        }

    }
    
    }
}
?>