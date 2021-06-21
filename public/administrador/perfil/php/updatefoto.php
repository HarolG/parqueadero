<?php

include("../../../../php/conexion.php");

if (isset($_POST['update'])) {
    $foto = $_FILES["foto"]["name"];
    $ruta = $_FILES["foto"]["tmp_name"];
    $destino = "../fotos/" . $foto;
    copy($ruta, $destino);

    $consulta = "UPDATE usuario SET foto = '$foto' WHERE id_tip_usu = 1";
    $query = mysqli_query($mysqli,$consulta);

    if ($query) {
        echo '<script type="text/javascript">
                alert("Se actualizo el avatar correctamente");
                window.location.href="../perfil.php";
            </script>';
    } else {
        echo 'no se actualizo';
    }
    
}

?>