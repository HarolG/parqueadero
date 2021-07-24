<?php

    include("../../../../php/conexion.php");

    if(isset($_GET['id_zona'])) {
        $id = $_GET['id_zona'];
        $query = "DELETE FROM zona_parqueo WHERE id_zona = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: ../zona.php");
        }
      }

?>