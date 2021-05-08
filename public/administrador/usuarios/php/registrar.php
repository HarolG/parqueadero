<?php
    include("../../../../php/conexion.php");
?> 

<!-- 
Importante,
Esto es solo una plantilla
En caso de que las imagenes no se inserten, o los estilos no se inserten
Favor revisar los direccionamientos 
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="../css/registro.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"rel="stylesheet">
    <!-- funcion para hacer una pregunta -->
    <script type="text/javascript">
		function confirmar(){
			return confirm('¿Estas Seguro? se eliminaran los datos y no podras restaurarlos');

		}

	</script>
    
</head>

<body>
    <div class="container">
        <div class="navegacion">
            <div class="site_title">
                <img src="../../../../img/logo_blanco.png" alt="logo" class="logo">
            </div>
            <div class="nav_profile">
                <div class="profile_pic">
                    <img src="../../../../img/foto_perfil.png" alt="">
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
                        <a href="../home/administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
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
                    <li>
                        <a href="../usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../crear/crearusu.php"> <i class="fa fa-car" aria-hidden="true"> Registrar Vehiculos </i></i></a>
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
        <!-- Aquí va el contenido -->
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
                            <img src="../../../../img/foto_perfil.png" alt="">
                        </div>
                            <ul class="navy">
                                <li>
                                    <a href=""><p><?php echo $_SESSION['nom'];?><i class="fa fa-caret-down" aria-hidden="true"></i></p></a>
                                    <ul>
                                        <li><a href="">Your Profile</a></li>
                                        <li><a href="">Settings</a></li>
                                        <li><a href="../../../../php/cerrarsesion.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                
            </div>  
        <div>
            <!-- codigo para registrar un tipo de usuario nuevo -->
        <div id="tipousu" class="mostrar">
            <form class="form1" method="POST">
                <i class="fas fa-times" onclick="cerrar1();"></i>
                <label>Registrar nuevo</label> <br>
                <label>Tipo de usuario</label>
                <input type="text" name="restipusu" placeholder="Tipo de usuario" class="input" autocomplete="off">   
                <input type="submit" value="Registrar" class="btn">
                <input type="hidden" name="regisusu">
            </form>
             <?php
                    
                    if(isset($_POST['regisusu'])){
                        $tipusu=$_POST['restipusu'];
                       
                        
                        $sql="INSERT INTO `tipo_usuario` (nom_tip_usu) VALUES ('$tipusu')";
                            
                        $resul=mysqli_query($mysqli,$sql);
                            
                        if($resul){  
                            echo "<script language='JavaScript'>
                            alert('Se ha creado el tipo de usuario correctamente');
                            window.location.href='registrar.php';
                            </script>";  
                        }else{
                            echo "<script language='JavaScript'>
                            alert('el tipo de usuario no fue creado');
                            </script>";
                        }
                        mysqli_close($mysqli);
                    }else{          
                ?>
                <?php
                    }
            ?>
        </div>

           <!-- codigo para registrar un tipo de documento nuevo -->
        <div id="tipodoc" class="mostrar1">
            <form class="form2" method="POST">
                <i class="fas fa-times" onclick="cerrar2();"></i>
                <label class="label">Registrar nuevo</label> <br>
                <label class="label">Tipo de documento</label>
                <input type="text" name="restipdoc" placeholder="Tipo de usuario" class="input1" autocomplete="off">   
                <input type="submit" value="Registrar" class="btn1">
                <input type="hidden" name="regisdoc">
            </form>
             <?php
                    
                    if(isset($_POST['regisdoc'])){
                        $tipdoc=$_POST['restipdoc'];
                       
                        
                        $sql="INSERT INTO `tipo_documento` (nom_tip_doc) VALUES ('$tipdoc')";
                            
                        $resul=mysqli_query($mysqli,$sql);
                            
                        if($resul){  
                            echo "<script language='JavaScript'>
                            alert('Se ha creado el tipo de documento correctamente');
                            window.location.href='registrar.php';
                            </script>";  
                        }else{
                            echo "<script language='JavaScript'>
                            alert('el tipo de documento no fue creado');
                            </script>";
                        }
                        mysqli_close($mysqli);
                    }else{          
                ?>
                <?php
                    }
            ?>
        </div>

        <div class="uno">
                        <h1>REGISTRO DE USUARIO</h1>
                        <a href="../usuarios.php" class="back" style="text-decoration:none;"><i class="fas fa-hand-point-left"></i></a>
                   
                    <div class="dos">
                        <form method="POST" class="form">
                                <!-- input de documento -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Documento</label>
                                <input type="number" id="documento" name="documento" placeholder="Documento" class="extras2" required
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
                                <input type="number" id="edad" name="edad" placeholder="Edad" class="extras2" required autocomplete="off">
                            </div>
                                <!-- input de celular -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Celular</label>
                                <input type="number" id="celular" name="celular" placeholder="Celular" class="extras2" required autocomplete="off">
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
                                <label for="" class="extras1">Tipo de usuario</label> <br>
                                <a onclick="tipoUsu()" class="extras1" style="cursor:pointer; text-decoration: underline; color:blue;">Registrar nuevo tipo de usuario</a>
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
                                <label for="" class="extras1">Tipo de documento</label> <br>
                                <a onclick="tipoDoc()" class="extras1" style="cursor:pointer; text-decoration: underline; color:blue;">Registrar nuevo tipo de documento</a>
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
    </div>
    <script type="text/javascript">
    function tipoUsu(){

        document.getElementById('tipousu').style.display ='block';
        
    }
    function cerrar1() {
        
        document.getElementById('tipousu').style.display ='none';
    }
    function cerrar2() {
        document.getElementById('tipodoc').style.display ='none';
    }
    function tipoDoc(){

        document.getElementById('tipodoc').style.display ='block';
        
    }



</script>
</body>
</html>
