<?php
    require '../../../php/conexion.php';

    if(isset($_POST["registro"])){
        //Declaramos las variables para almacenar los datos digitados
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $vehiculo = $_POST['vehiculo'];
        $color = $_POST['color'];
        $anota = $_POST['anotaciones'];
        $doc = $_POST['doc'];
        $estado_vehiculo = 4;
        
        $foto = $_FILES["vehic"]["name"];
        $ruta_ = $_FILES["vehic"]["tmp_name"];
        $tarjeta= $_FILES["tarjeta"]["name"];
        $ruta = $_FILES["tarjeta"]["tmp_name"];
        $dir_subida = 'archivos/' .$foto .$tarjeta;
        copy($ruta, $dir_subida);

        $consu = "INSERT INTO vehiculo (foto, Tarjeta_Prop) VALUES ('$foto', '$tarjeta')";
        $query = mysqli_query($mysqli,$consu);

            if ($query) {
                echo '<script type="text/javascript">
                        alert("Se actualizo el avatar correctamente");
                        window.location.href="../perfil.php";
                    </script>';
            } 
        
        
        //Hacemos la consulta para que me seleccione los datos en la BD y valide
        $consul = "INSERT INTO vehiculo (placa, id_modelo, id_marca, id_tip_vehiculo, id_color, anotaciones) 
        VALUES ('$placa', '$modelo', '$marca', '$vehiculo', '$color', '$anota')";
        $consulta = "INSERT INTO detalle_vehiculo (placa, documento, id_estado)     
        VALUES ('$placa', '$doc', '$estado_vehiculo')";
        $query = mysqli_query($mysqli, $consul);
        $query = mysqli_query($mysqli,$consulta);;

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
?>


        
