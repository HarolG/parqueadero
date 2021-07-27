<?php

include("../../../../php/conexion.php");

if (isset($_POST['subir'])) {
    $foto = $_FILES["foto"]["name"];
    $ruta = $_FILES["foto"]["tmp_name"];
    $destino = "../../perfil/fotos/" . $foto;
    copy($ruta, $destino);

    $consulta = "UPDATE usuario SET foto = '$foto' WHERE id_tip_usu = 1";
    $query = mysqli_query($mysqli,$consulta);

    if ($query) {
        
    } else {
        echo 'no se subio tu foto';
    }
    
}

?>