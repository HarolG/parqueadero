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
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="css/registro.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navegacion">
            <div class="site_title">
                <img src="../../../img/logo_blanco.png" alt="logo" class="logo">
            </div>
            <div class="nav_profile">
                <div class="profile_pic">
                    <img src="../../../img/foto_perfil.png" alt="">
                </div>
                <div class="profile_info">
                    <div>
                        <p class="profile_welcome">Bienvenido,</p>
                        <p class="profile_name"><?php echo $_SESSION['nom']," ", $_SESSION['ape']?></p>
                    </div>
                </div>
            </div>
            <div class="menu_section">
                <h5>GENERAL</h5>
                <ul>
                    <li>
                        <a href="administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Reporte de Entradas </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>

                </ul>
            </div>
            <div class="menu_section">
                <h5>SUBGENERAL</h5>
                <ul>
                    
                    <li>
                        <a href="usuarios.php"><i class="fa fa-users" aria-hidden="true"> Usuarios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../public/administrador/crear/crearusu.php"> <i class="fa fa-car" aria-hidden="true"> Registrar Vehiculos </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                </ul>
            </div>
            <!-- <div class="menu_section">
                <h5>PROXIMAMENTE</h5>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-chart-pie " aria-hidden="true"> Informes </i></a>
                        <div class="nav_decorate"></div>
                    </li>

                </ul>
            </div> -->
        </div>
        <div class="contenido">
           <div class="nav_menu">
                <div class="container_nav-menu">
                    <div class="icon_menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="enlaces">
                        <ul>
                            <li><strong><a href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a></strong></li>
                            <li><strong><a href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a></strong></li>
                        </ul>
                    </div>
                    <div class="user">
                        <div class="user_pic">
                            <img src="../../../img/foto_perfil.png" alt="">
                        </div>
                        <p><?php echo $_SESSION['nom']," ", $_SESSION['ape']?><i class="fa fa-caret-down" aria-hidden="true"></i></p>
                    </div>
                </div>
           </div>
           <!-- Aquí va el contenido -->
                <div class="uno">
                    <h1>REGISTRO DE USUARIO</h1>
                    <a href="usuarios.php" class="back" style="text-decoration:none;"><i class="fas fa-hand-point-left" ></i></a>
                    <div class="dos">
                        <form method="POST" class="form">
                                <!-- input de documento -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Documento</label>
                                <input type="text" id="documento" name="documento" placeholder="Documento" class="extras2" required
                                autocomplete="off">
                            </div>
                                <!-- input de nombre -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de apellido -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Apellido</label>
                                <input type="text" id="apellido" name="apellido" placeholder="Apellido" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de edad -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Edad</label>
                                <input type="text" id="edad" name="edad" placeholder="Edad" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de celular -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Celular</label>
                                <input type="text" id="celular" name="celular" placeholder="Celular" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de direccion-->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Dirección</label>
                                <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de correo -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Correo</label>
                                <input type="email" id="correo" name="correo" placeholder="Correo" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de clave -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Clave</label>
                                <input type="text" id="clave" name="clave" placeholder="Clave" class="extras2" required autocomplete="off">
                            </div>
                                <!-- TIPO DE USUARIO -->
                            <div class="cajitas">
                                <label for="" class="extras1">Tipo de usuario</label>
                                <select id="" name="tipo_usuario" class="extras2">
                        <!-- consultas y codigo para validar que los registros esten el la bd y guardarlos en una lista -->
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

  
                