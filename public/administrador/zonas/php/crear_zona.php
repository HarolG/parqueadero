<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['guardar'])) {
        
        // $idzona = $_POST['idzona'];
        $tipozona = $_POST['tipozona'];
        // $cupo = $_POST['cupos_zona'];
        $estado = $_POST['cupozona'];
        // $cupolive = $_POST['cupos_zona'];

        // $sqli = "INSERT INTO zona_parqueo (id_zona, id_tip_zona, id_estado, cupos, cupos_live) VALUES (NULL, '$tipozona', '$estado', '$cupo', '$cupolive')";
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