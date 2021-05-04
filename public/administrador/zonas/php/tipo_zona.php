<?php

include("../../../../php/conexion.php");

if (isset($_POST['guardar'])) {
    $zona = $_POST['zonita'];

    $sql = "INSERT INTO tipo_zona (id_tip_zona, nom_tip_zona) VALUES (NULL, '$zona')";
    $query = mysqli_query($mysqli, $sql);

    if ($query) {
        echo '<script type="text/javascript">
                    alert("Se creo el tipo de zona correctamente");
                    window.location.href="form_tip_zona.php";
              </script>';
    } else {
        echo '<script type="text/javascript">
                alert("ERROR");
                window.location.href="form_tip_zona.php";
            </script>';
    }
}

?>