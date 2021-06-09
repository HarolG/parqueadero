<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['enviar_cupo'])) {
        
        $zona = $_POST['id_zona'];
        $nom_cupo = $_POST['nombre_cupo'];
        $est_cupo = $_POST['estado_cupo'];

        $sqli = "INSERT INTO detalle_cupos (id_deta_cupos, id_zona, placa, nombre_cupo, id_estado_cupo) VALUES (NULL, '$zona', NULL, '$nom_cupo', '$est_cupo')";
        $query = mysqli_query($mysqli, $sqli);

        if ($query) {
            echo'<script type="text/javascript">
                    alert("Se creo el cupo correctamente");
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