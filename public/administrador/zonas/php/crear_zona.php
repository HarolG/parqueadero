<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['guardar'])) {
        $tipozona = $_POST['tipozona'];
        $estado = $_POST['cupozona'];

        $sqli = "INSERT INTO zona_parqueo (id_zona, id_tip_zona, id_estado) VALUES (NULL, '$tipozona', '$estado')";
        $query = mysqli_query($mysqli, $sqli);

        if ($query) {
            echo'<script type="text/javascript">
                    alert("Se creo la zona correctamente");
                    window.location.href="../zona.php";
                </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("ID de la zona ya existe");
                    window.location.href="../zona.php";
                </script>';
        }

    }

?>