<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['enviar_cupo'])) {
        
        $zona = $_POST['id_zona'];
        $nom_cupo = $_POST['cantidad_cupos'];
        $est_cupo = $_POST['estado_cupo'];

        $sql = "SELECT count(nombre_cupo) AS cantidad_cupos_bd FROM detalle_cupos WHERE id_zona = '$zona'";
        $query = mysqli_query($mysqli, $sql);
        $resultado = mysqli_fetch_assoc($query);

        $resultado['cantidad_cupos_bd'] = $resultado['cantidad_cupos_bd'] + 1;

        $suma = $resultado['cantidad_cupos_bd'] + $nom_cupo;

        for ($i = $resultado['cantidad_cupos_bd']; $i < $suma; $i++){
            $sqli = "INSERT INTO detalle_cupos (id_deta_cupos, id_zona, id_deta_vehiculo, nombre_cupo, id_estado) 
                     VALUES (NULL, '$zona', NULL, '$i', '$est_cupo')";
            $query = mysqli_query($mysqli, $sqli);

            if ($query) {
                echo'<script type="text/javascript">
                    alert("Se ha creado el cupo");
                    window.location.href="../zona.php";
                    </script>';
                    // header("Location: ../zona.php");
            } else {
                echo '<script type="text/javascript">
                        alert("No se creo el cupo");
                        window.location.href="../zona.php";
                    </script>';
            }
        }


    }

?>