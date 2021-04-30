<?php
    require '../../../php/conexion.php';

    if($_POST["registro"]){
        //Declaramos las variables para almacenar los datos digitados
        $placa = $_POST["placa"];
        $modelo = $_POST["modelo"];
        $marca = $_POST["marca"];
        $vehiculo = $_POST["vehiculo"];
        $doc = $_POST["doc"];
        $color = $_POST["color"];
        $anota = $_POST["anotaciones"];
 //      $soat = $_POST["fichero_usuario"];
 //       $tecnomecanica = $_POST["fichero_usuario"];
 //       $foto = $_POST["fichero_usuario"];
        
        
        //Hacemos la consulta para que me seleccione los datos en la BD y valide
        $consul = "INSERT INTO vehiculo(placa, id_modelo, id_marca, id_tip_vehiculo, documento, soat, tecnomecanica, foto, id_color, anotaciones) 
        VALUES('$placa', '$modelo', '$marca', '$vehiculo', '$doc', '$color', '$anota', null. null, null)";
        $query = mysqli_query($mysqli,$consul);

        if(!$query){
            echo '<script> alert ("Error al registrarlo");</script>';
            echo '<script> window.location="crearusu.php </script>';
        }
        else{
            echo '<script> alert ("Exito al registrarlo");</script>';
            echo '<script> window.location="crearusu.php" </script>';
        }
    }
    else{
        echo '<script> alert ("Ups algo fallo, intentalo de nuevo");</script>';
        echo '<script> window.location="crearusu.php" </script>';
    }


?>

<?php
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.

$dir_subida = 'crearusu.php';//'/var/www/uploads/';
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

echo 'Más información de depuración:';
print_r($_FILES);
print "</pre>";

?>
