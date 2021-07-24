<?php

    include("../../../../php/conexion.php");

    if(isset($_GET['id_estado'])) {
        $id = $_GET['id_estado'];
        $query = "DELETE FROM estado WHERE id_estado = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../includes/form_tip_estado.php");
        }
      }

?>