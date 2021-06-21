<?php

    include("../../../../php/conexion.php");

    if (isset($_POST['enviar_cupo'])) {
        
        $zona = $_POST['id_zona'];
        $nom_cupo = $_POST['cantidad_cupos'];
        $est_cupo = $_POST['estado_cupo'];

        // $sqll = "SELECT SUM(nombre_cupo) AS cantidad_cupos 
        //          FROM detalle_cupos 
        //          WHERE id_zona = $zona";
        // $resultado = mysqli_query($mysqli,$sqll);
		// $fila = mysqli_fetch_assoc($resultado);

        // if ($fila['cantidad_cupos'] == 0) {
        //     $fila['cantidad_cupos'] = 1;
        // }

        // $suma = ($fila['cantidad_cupos'] + $nom_cupo);
        // echo $suma;

        for ($i = 1; $i <= $nom_cupo; $i++){
            $sqli = "INSERT INTO detalle_cupos (id_deta_cupos, id_zona, placa, nombre_cupo, id_estado_cupo) 
                     VALUES (NULL, '$zona', NULL, '$nom_cupo', '$est_cupo')";
            $query = mysqli_query($mysqli, $sqli);

            if ($query) {
                echo'<script type="text/javascript">
                        alert("Se creo el cupo correctamente");
                        window.location.href="../zona.php";
                    </script>';
            } else {
                echo '<script type="text/javascript">
                        alert("No se creo el cupo");
                        window.location.href="../zona.php";
                    </script>';
            }
        }


    }

?>