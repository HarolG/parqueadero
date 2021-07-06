<?php

require '../../../../php/conexion.php';

    if(isset($_POST["enviar-vehi"])){
    //Declaramos las variables para almacenar los datos digitados
        $vehi = $_POST['nom_tipo_vehiculo'];


        $consult = "INSERT INTO tipo_vehiculo (nom_tipo_vehiculo) VALUES ('$vehi')";
        $query = mysqli_query($mysqli, $consult);

        if(!$query){
            echo '<script> alert ("Error al registrarlo");</script>';
            echo '<script> window.location="../crearusu.php </script>';
        }
        else{
            echo '<script> alert ("Exito al registrarlo");</script>';
            echo '<script> window.location="../crearusu.php" </script>';
        }
    }
    else{
        echo '<script> alert ("Ups algo fallo, intentalo de nuevo");</script>';
        echo '<script> window.location="../crearusu.php" </script>';
    }



    if(isset($_POST["enviar-marca"])){
        //Declaramos las variables para almacenar los datos digitados
            $marc = $_POST['nom_marca'];
    
    
            $consult = "INSERT INTO marca (nom_marca) VALUES ('$marc')";
            $query = mysqli_query($mysqli, $consult);
    
            if(!$query){
                echo '<script> alert ("Error al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php </script>';
            }
            else{
                echo '<script> alert ("Exito al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php" </script>';
            }
        }
        else{
            echo '<script> alert ("Ups algo fallo, intentalo de nuevo");</script>';
            echo '<script> window.location="../crearusu.php" </script>';
        }



    if(isset($_POST["enviar-modelo"])){
        //Declaramos las variables para almacenar los datos digitados
            $model = $_POST['nom_modelo'];
        
        
            $consult = "INSERT INTO modelo (nom_modelo) VALUES ('$model')";
            $query = mysqli_query($mysqli, $consult);
        
            if(!$query){
                echo '<script> alert ("Error al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php </script>';
            }
            else{
                echo '<script> alert ("Exito al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php" </script>';
            }
        }
        else{
            echo '<script> alert ("Ups algo fallo, intentalo de nuevo");</script>';
            echo '<script> window.location="../crearusu.php" </script>';
        }
        
        
        
    if(isset($_POST["enviar-color"])){
        //Declaramos las variables para almacenar los datos digitados
            $col = $_POST['nom_color'];
            
            
            $consult = "INSERT INTO color (nom_color) VALUES ('$col')";
            $query = mysqli_query($mysqli, $consult);
            
            if(!$query){
                echo '<script> alert ("Error al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php </script>';
            }
            else{
                echo '<script> alert ("Exito al registrarlo");</script>';
                echo '<script> window.location="../crearusu.php" </script>';
            }
        }
        else{
            echo '<script> alert ("Ups algo fallo, intentalo de nuevo");</script>';
            echo '<script> window.location="../crearusu.php" </script>';
        }
?>