<?php
    include("conexion.php");

    session_start();

    session_destroy();
    session_write_close();
    header("location: ../public/login/login.html");


?>