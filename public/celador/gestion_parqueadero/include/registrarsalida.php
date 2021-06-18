<?php

    if(isset($_POST['id_deta_cupos'])) {

        if($_POST['estado_cupo'] == "Ocupado") {
            
            $id_deta_cupos = $_POST['id_deta_cupos'];
            $estado_cupo = $_POST['estado_cupo'];

            

        } else {
            echo'<script type="text/javascript">
                    alert("Este cupo se encuentra disponible");
                    window.location.href="../home.php";
                </script>';
        }

    } else {
        echo'<script type="text/javascript">
                    alert("Ups! algo ha fallado");
                    window.location.href="../home.php";
            </script>';
    }

?>