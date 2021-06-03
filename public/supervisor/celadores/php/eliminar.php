<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['documento'])) {
        $id = $_GET['documento'];
        $query = "DELETE FROM informe_celadores WHERE documento = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../index.php");
        }
      }

?>