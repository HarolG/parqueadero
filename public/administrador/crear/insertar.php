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
<<<<<<< HEAD
=======
    else{
        echo '<script> alert ("El formulario ha sido registrado correctamente");</script>';
        echo '<script> window.location="crearusu.php" </script>';
    }


?>


<?php

require '../../../php/conexion.php';

    if(isset($_POST["enviar-vehi"])){
    //Declaramos las variables para almacenar los datos digitados
        $vehi = $_POST['nom_tipo_vehiculo'];


        $consult = "INSERT INTO tipo_vehiculo (nom_tipo_vehiculo) VALUES ('$vehi')";
        $query = mysqli_query($mysqli, $consult);

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



    if(isset($_POST["enviar-marca"])){
        //Declaramos las variables para almacenar los datos digitados
            $marc = $_POST['nom_marca'];
    
    
            $consult = "INSERT INTO marca (nom_marca) VALUES ('$marc')";
            $query = mysqli_query($mysqli, $consult);
    
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



    if(isset($_POST["enviar-modelo"])){
        //Declaramos las variables para almacenar los datos digitados
            $model = $_POST['nom_modelo'];
        
        
            $consult = "INSERT INTO modelo (nom_modelo) VALUES ('$model')";
            $query = mysqli_query($mysqli, $consult);
        
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
        
        
        
    if(isset($_POST["enviar-color"])){
        //Declaramos las variables para almacenar los datos digitados
            $col = $_POST['nom_color'];
            
            
            $consult = "INSERT INTO color (nom_color) VALUES ('$col')";
            $query = mysqli_query($mysqli, $consult);
            
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
>>>>>>> 3967f975a1eb99c81d5ce98f0371fe9cbf2f05bc
?>
