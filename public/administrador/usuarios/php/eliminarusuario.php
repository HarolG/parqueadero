<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['documento'])) {
        $id = $_GET['documento'];
        $query = "DELETE FROM usuario WHERE documento = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../usuarios.php.php");
        }
      }

?>