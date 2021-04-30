<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include("../../../php/conexion.php");
?>
    <?php
    if(isset($_POST['aux'])){

        $docu=$_GET["documento"];
        $edad=$_POST["edad"];
        $correo=$_POST["correo"];
       

        $consul="UPDATE usuario SET edad='$edad', correo='$correo' WHERE documento='$docu' ";
        $res=mysqli_query($mysqli,$consul);
                                      
        if($res){
            echo'<script type="text/javascript">
            alert("los datos si fueron editados correctamente");
            window.location.href="usuarios.php";
            </script>';
        }else{
            echo'<script type="text/javascript">
            alert("los datos fueron editados correctamente");
            </script>';
        }
        mysqli_close($mysqli);

    }else{
        $documen=$_GET['documento'];                               
                            
        $sql="SELECT usuario.documento,usuario.nombre,usuario.apellido,usuario.edad,usuario.celular,usuario.direccion,usuario.correo,usuario.clave,tipo_usuario.nom_tip_usu,tipo_documento.nom_tip_doc FROM usuario
            INNER JOIN tipo_usuario on usuario.id_tip_usu = tipo_usuario.id_tip_usu
            INNER JOIN tipo_documento on usuario.id_tip_doc = tipo_documento.id_tip_doc
            WHERE usuario.documento ='".$documen."'";
            
        $resul=mysqli_query($mysqli,$sql);
        $fila=mysqli_fetch_assoc($resul);
        
        
        $nombre=$fila['nombre'];
        $apellido=$fila['apellido'];
        $edad=$fila['edad'];
        $celular=$fila['celular'];
        $direccion=$fila['direccion'];
        $correo=$fila['correo'];
        $clave=$fila['clave'];                      
?>
    <form method="POST">
            <!-- input de documento -->
            <div class="cajitas">
                <label for="placa" class="extras1">Documento</label>
                <input type="text" id="documento" name="documento" value="<?php echo $documen;?>" class="extras2" required
            autocomplete="off">
            </div>                             
            <!-- input de nombre -->
            <div class="cajitas">
                <label for="placa" class="extras1">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>"  class="extras2" required>
            </div>
                <!-- input de apellido -->
            <div class="cajitas">
                <label for="placa" class="extras1">Apellido</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido;?>"  class="extras2" required>
            </div>
                <!-- input de edad -->
            <div class="cajitas">
                <label for="placa" class="extras1">Edad</label>
                <input type="text" id="edad" name="edad" value="<?php echo $edad;?>"  class="extras2" required>
            </div>
                <!-- input de celular -->
            <div class="cajitas">
                <label for="placa" class="extras1">Celular</label>
                <input type="text" id="celular" name="celular" value="<?php echo $celular;?>"  class="extras2" required>
            </div>
                <!-- input de direccion-->
            <div class="cajitas">
                <label for="placa" class="extras1">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion;?>"  class="extras2" required>
            </div>
                <!-- input de correo -->
            <div class="cajitas">
                <label for="placa" class="extras1">Correo</label>
                <input type="text" id="correo" name="correo" value="<?php echo $correo;?>" class="extras2" required>
            </div>
               <!-- input de clave -->
            <div class="cajitas">
                <label for="placa" class="extras1">clave</label>
                <input type="text" id="clave" name="clave" value="<?php echo $clave;?>" class="extras2" required>
            </div>
                <!-- TIPO DE USUARIO -->
            <div class="cajitas">
                <label for="" class="extras1">Tipo de usuario</label>
                <select id="" name="tipo_usuario1" class="extras2">
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
                    <select id="" name="tipo_documento1" class="extras2">
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
                            <input type="submit" value="EDITAR" class="boton">
                            <input type="hidden" name="aux" value="registrar_usuario">
                        </div>
                    </form>
<?php
}
?> 
</body>
</html>