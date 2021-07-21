<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['id_informe_celador'])) {
        $id = $_GET['id_informe_celador'];
        $query = "DELETE FROM informe_celadores WHERE id_informe_celador = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../index.php");
        }
      }

?>