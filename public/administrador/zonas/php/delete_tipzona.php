<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['id_tip_zona'])) {
        $id = $_GET['id_tip_zona'];
        $query = "DELETE FROM tipo_zona WHERE id_tip_zona = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../includes/form_tip_zona.php");
        }
      }

?>