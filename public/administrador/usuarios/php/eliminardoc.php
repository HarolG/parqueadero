<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['id_tip_doc'])) {
        $id = $_GET['id_tip_doc'];
        $query = "DELETE FROM tipo_documento WHERE id_tip_doc = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: registrar_tipdoc.php");
        }
      }

?>