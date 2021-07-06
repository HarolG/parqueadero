<?php
    require '../../../php/conexion.php';
    $dir_subida = 'archivos/';

    if(isset($_POST["registro"])){
        //Declaramos las variables para almacenar los datos digitados
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $vehiculo = $_POST['vehiculo'];
        $doc = $_POST['doc'];
        $color = $_POST['color'];
        $anota = $_POST['anotaciones'];


        if(isset($_FILES['file'])) { 
            $directorio = "image/";
        
            $tarjeta = $directorio . basename($_FILES["file"]["name"]); // uploads/carta.pdf
            $nombreArchivo = $_FILES["file"]["name"];
            $tipoArchivo = strtolower(pathinfo($tarjeta, PATHINFO_EXTENSION));
            $tamañoArchivo = $_FILES["file"]["size"];
            if($tipoArchivo === "png" || $tipoArchivo === "jpg" || $tipoArchivo === "jpeg") {
                if ($tamañoArchivo <= 209715200) {
        
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $tarjeta)){
                        $consulta = "INSERT INTO vehiculo(Tarjeta_Prop) VALUES ('$tarjeta')";
                        $query = mysqli_query($mysqli, $consulta);
                    } else {
                        echo "<script>alert('Ha ocurrido un error al subir el archivo')</script>";
                    }
        
                } else {
                    echo "<script>alert('El peso del archivo es superior a 200MB')</script>";
                }   
            } else {
                echo "<script>alert('El tipo de archivo subido no es admitido, solo se admite imágenes (jpg, png, jpeg)')</script>";
            }
        }
        
        //Hacemos la consulta para que me seleccione los datos en la BD y valide
        $consul = "INSERT INTO vehiculo (placa, id_modelo, id_marca, id_tip_vehiculo, documento, id_color, anotaciones) 
        VALUES ('$placa', '$modelo', '$marca', '$vehiculo', '$doc', '$color', '$anota')";
        $query = mysqli_query($mysqli, $consul);

        if(!$query){
            echo '<script> alert ("Error al registrarlo");</script>';
            echo '<script> window.location="crearusu.php </script>';
        }
        else{
            echo '<script> alert ("Exito al registrarlo");</script>';
            echo '<script> window.location="crearusu.php" </script>';
        }
    }
?>
