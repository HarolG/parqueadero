<?php
    include("conexion.php");

    $sql = "UPDATE informe_celadores SET fecha_salida = NOW() WHERE id_tip_usu = 2";
    mysqli_query($mysqli,$sql);

    session_start();

    session_destroy();
    session_write_close();
    header("location: ../index.php");


?>