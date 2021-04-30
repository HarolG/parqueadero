<?php
include("../../../php/conexion.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="modal_container" class="modal-container">
                    <div class="modal">
                        <h1>REGISTRO DE USUARIO</h1>
                        <i class="fas fa-times" id="close"></i>
                        <div class="card">
                            <form method="POST">
                                <!-- input de documento -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Documento</label>
                                    <input type="text" id="documento" name="documento" placeholder="Documento" class="extras2" required
                                        autocomplete="off">
                                </div>
                                <!-- input de nombre -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="extras2" required>
                                </div>
                                <!-- input de apellido -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Apellido</label>
                                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" class="extras2" required>
                                </div>
                                <!-- input de edad -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Edad</label>
                                    <input type="text" id="edad" name="edad" placeholder="Edad" class="extras2" required>
                                </div>
                                <!-- input de celular -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Celular</label>
                                    <input type="text" id="celular" name="celular" placeholder="Celular" class="extras2" required>
                                </div>
                                <!-- input de direccion-->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Dirección</label>
                                    <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="extras2" required>
                                </div>
                                <!-- input de correo -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Correo</label>
                                    <input type="text" id="correo" name="correo" placeholder="Correo" class="extras2" required>
                                </div>
                                <!-- input de clave -->
                                <div class="cajitas">
                                    <label for="placa" class="extras1">Clave</label>
                                    <input type="text" id="clave" name="clave" placeholder="Clave" class="extras2" required>
                                </div>
                                <!-- TIPO DE USUARIO -->
                                <div class="cajitas">
                                    <label for="" class="extras1">Tipo de usuario</label>
                                    <select id="" name="tipo_usuario" class="extras2">
                                        <?php
                                                                $sql="SELECT*FROM tipo_usuario";
                                                                $query=mysqli_query($mysqli,$sql);
                                                                while($row=mysqli_fetch_array($query)){
                                                            ?>
                                        <option value="<?php echo $row['id_tip_usu']?>">
                                            <?php echo $row['nom_tip_usu']?>
                                        </option>
                
                                        <?php
                                                            }
                                                            ?>
                                    </select>
                                </div>
                                <!-- TIPO DE DOCUMENTO -->
                                <div class="cajitas">
                                    <label for="" class="extras1">Tipo de documento</label>
                                    <select id="" name="tipo_documento" class="extras2">
                                        <?php
                                                                $sql="SELECT*FROM tipo_documento";
                                                                $query=mysqli_query($mysqli,$sql);
                                                                while($row=mysqli_fetch_array($query)){
                                                            ?>
                                        <option value="<?php echo $row['id_tip_doc']?>">
                                            <?php echo $row['nom_tip_doc']?>
                                        </option>
                
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="caja">
                                    <input type="submit" value="REGISTRAR" class="boton">
                                    <input type="hidden" name="registrar" value="registrar_usuario">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CODIGO PHP PARA REGISTRAR USUARIOS -->
                <?php
                    
                    if(isset($_POST['registrar'])){
                        $documento=$_POST['documento'];
                        $nombre=$_POST['nombre'];
                        $apellido=$_POST['apellido'];
                        $edad=$_POST['edad'];
                        $celular=$_POST['celular'];
                        $direccion=$_POST['direccion'];
                        $correo=$_POST['correo'];
                        $clave=$_POST['clave'];
                        $tip_usu=$_POST['tipo_usuario'];
                        $tip_docu=$_POST['tipo_documento'];
                        
                        $sql="INSERT INTO `usuario` (`documento`, `nombre`, `apellido`, `edad`, `celular`, `direccion`,`correo`, `clave`, `id_tip_usu`,`id_tip_doc`) VALUES ('$documento','$nombre','$apellido','$edad','$celular','$direccion','$correo','$clave','$tip_usu','$tip_docu')";
                            
                        $resul=mysqli_query($mysqli,$sql);
                            
                        if($resul){  
                            echo "<script language='JavaScript'>
                            alert('Se ha creado el usuario correctamente');
                            </script>";  
                        }else{
                            echo "<script language='JavaScript'>
                            alert('los datos no fueron ingresados correctamente');
                            </script>";
                        }
                        mysqli_close($mysqli);
                    }else{          
                ?>
                <?php
                    }
            ?>
</body>
</html>