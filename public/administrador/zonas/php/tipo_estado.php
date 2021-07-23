<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['guardar'])) {
        $estado = $_POST['estado'];
        $categoria = 1;

        $sql = "INSERT INTO estado (id_estado, nom_estado, id_categoria) VALUES (NULL, '$estado', '$categoria')";
        $query = mysqli_query($mysqli, $sql);

        if ($query) {
            echo '<script type="text/javascript">
                        alert("Se creo el estado correctamente");
                        window.location.href="../includes/form_tip_estado.php";
                  </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("ERROR");
                    window.location.href="../includes/form_tip_estado.php";
                </script>';
        }
    }


?>