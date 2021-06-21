<?php

    include("../../../../php/conexion.php");

    if  (isset($_GET['id_tip_usu'])) {
        $id = $_GET['id_tip_usu'];
        $query = "DELETE FROM tipo_usuario WHERE id_tip_usu = $id";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            header("Location: registrar_tipusu.php");
        }
      }

?>