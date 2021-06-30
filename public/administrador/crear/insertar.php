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
        $soat = $_POST["sooat"];
        $tecno = $_POST["tecno"];
        $foto = $_POST["vehic"];


        $fichero_subido_foto = $dir_subida . basename($_FILES['vehic']['name']);
     
             echo '<pre>';
             if (move_uploaded_file($_FILES['vehic']['tmp_name'], $fichero_subido_foto)) {
                 //echo "El fichero es válido y se subió con éxito.\n";
                 echo '<script> window.location="crearusu.php" </script>';
             } else {
                 //echo "¡Posible ataque de subida de ficheros!\n";
                 echo '<script> window.location="crearusu.php" </script>';
             }
     
             echo 'Más información de depuración:';
             print_r($_FILES);
             print "</pre>";
        
        $fichero_subido_tecno = $dir_subida . basename($_FILES['tecno']['name']);
     
             echo '<pre>';
             if (move_uploaded_file($_FILES['tecno']['tmp_name'], $fichero_subido_tecno)) {
                 //echo "El fichero es válido y se subió con éxito.\n";
                 echo '<script> window.location="crearusu.php" </script>';
             } else {
                 //echo "¡Posible ataque de subida de ficheros!\n";
                 //echo '<script> window.location="crearusu.php" </script>';
             }
     
             echo 'Más información de depuración:';
             print_r($_FILES);
             print "</pre>";

        $fichero_subido_soat = $dir_subida . basename($_FILES['sooat']['name']);
     
             echo '<pre>';
             if (move_uploaded_file($_FILES['sooat']['tmp_name'], $fichero_subido_soat)) {
                 echo "El fichero es válido y se subió con éxito.\n";
                 echo '<script> window.location="crearusu.php" </script>';
             } else {
                 echo "¡Posible ataque de subida de ficheros!\n";
                 //echo '<script> window.location="crearusu.php" </script>';
             }
     
             echo 'Más información de depuración:';
             print_r($_FILES);
             print "</pre>";
     

     
        
        //Hacemos la consulta para que me seleccione los datos en la BD y valide
        $consul = "INSERT INTO vehiculo (placa, id_modelo, id_marca, id_tip_vehiculo, documento, id_color, anotaciones, soat, tecnomecanica, foto) 
        VALUES ('$placa', '$modelo', '$marca', '$vehiculo', '$doc', '$color', '$anota', '$fichero_subido_soat', '$fichero_subido_tecno', '$fichero_subido_foto')";
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
?>
