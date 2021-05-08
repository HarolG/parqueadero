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
    <link rel="stylesheet" href="../css/editar.css">
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
                        <a href="../../home/administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Reporte de Entradas </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../crear/crearusu.php"> <i class="fa fa-car" aria-hidden="true"> Registrar Vehiculos </i></i></a>
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
                                        <li><a href="../../../php/cerrarsesion.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
      <?php
                if(isset($_POST['aux'])){
            
                    $docu=$_GET["documento"];
                    $edad=$_POST["edad"];
                    $correo=$_POST["correo"];
                   
            
                    $consul="UPDATE usuario SET edad='$edad', correo='$correo' WHERE documento='$docu' ";
                    $res=mysqli_query($mysqli,$consul);
                                                  
                    if($res){
                        echo'<script type="text/javascript">
                        alert("los datos fueron editados correctamente");
                        window.location.href="../usuarios.php";
                        </script>';
                    }else{
                        echo'<script type="text/javascript">
                            alert("los datos no fueron editados correctamente");
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
                <div class="uno">
                    <h1>EDITAR USUARIO</h1>
                     
                        <a href="../usuarios.php" class="back"><i class="fas fa-hand-point-left" ></i></a>
                    
                    <div class="dos">
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
                                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>" class="extras2" required>
                            </div>
                            <!-- input de apellido -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Apellido</label>
                                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido;?>" class="extras2" required>
                            </div>
                            <!-- input de edad -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Edad</label>
                                <input type="text" id="edad" name="edad" value="<?php echo $edad;?>" class="extras2" required>
                            </div>
                            <!-- input de celular -->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Celular</label>
                                <input type="text" id="celular" name="celular" value="<?php echo $celular;?>" class="extras2" required>
                            </div>
                            <!-- input de direccion-->
                            <div class="cajitas">
                                <label for="placa" class="extras1">Dirección</label>
                                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion;?>" class="extras2"
                                    required>
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
                    </div>
                </div>
                <?php
                }
                ?>


        <div>
    </div>
</body>
</html>
