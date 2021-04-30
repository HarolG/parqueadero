<?php
    include('../../../php/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="crearusu.css">
      <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
      <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
        <div class="navegacion">
            <div class="site_title">
                <span>Parqueadero</span>
            </div>
            <div class="nav_profile">
                <div class="profile_pic">
                    <img src="../../../img/foto_perfil.png" alt="">
                </div>
                <div class="profile_info">
                    <div>
                        <p class="profile_welcome">Bienvenido,</p>
                        <p class="profile_name">John Doe</p>
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
                        <a href="../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Registro de Entrada y Salida </i></i></a>
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
                        <a href="../public/administrador/usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios </i></a>
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
        <div class="contenido">
           <div class="nav_menu">
                <div class="container_nav-menu">
                    <div class="icon_menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="user">
                        <div class="user_pic">
                            <img src="../img/foto_perfil.png" alt="">
                        </div>
                        <p>John Doe <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                    </div>
                </div>
           </div>
           <!-- Aquí va el contenido -->
            <form enctype="multipart/form-data" action="insertar.php" method="POST" class="formur">
                <h2 class="title">Formulario para el registro de Vehiculos</h2>
                <div class="inicio">
                    <label for="placa">No. Placa</label><br>
                    <input type="text" class="placa" name="placa" placeholder="Ingrese Numero de la placa" autocomplete="off"><br> 
                    <label for="placa">Documento</label><br>
                    <input type="number" class="doc" name="doc" placeholder="Numero de Documento" autocomplete="off"><br> 
            <!--    Tipo de Vehiculo-->
                    <label class="vehiculo" for="placa">Tipo de Vehiculo</label><br>
                    <select class="vehiculo" name="vehiculo" id="sele" autocomplete="off">
                        
                        <option value="0">Tipo de Vehiculo</option>
                        <?php
                            $tip = "SELECT * FROM tipo_vehiculo";
                            $inser = mysqli_query($mysqli,$tip);
                            while($tip = mysqli_fetch_array($inser)){
                        ?>
                        <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?></option>
                        <?php
                        }
                        ?>
                        
                    </select><br> 
                </div>
            <!--    Modelo-->
                    <div class="modelo">
                        <label class="placa" for="placa">Modelo</label><br>
                        <select class="placa" name="modelo" id="sele" autocomplete="off">
                            <option  value="0">Modelo del Vehiculo</option>
                            <?php
                                $tipo = "SELECT * FROM modelo";
                                $inser = mysqli_query($mysqli,$tipo);
                                while($tip = mysqli_fetch_array($inser)){
                            ?>
                            <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                    
            <!--   Tipo de Marca-->
                        <label class="marca" for="placa">Marca</label><br>
                        <select class="marca" name="marca" id="sele" autocomplete="off">
                            <option value="0">Tipo de Marca</option>
                            <?php
                                $tipo = "SELECT * FROM marca";
                                $inser = mysqli_query($mysqli,$tipo);
                                while($tip = mysqli_fetch_array($inser)){
                            ?>
                            <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                    
            
                    
            <!--    Tipo de color-->
                        <label class="color" for="placa">Color del Vehiculo</label><br>
                        <select class="color" name="color" id="sele" autocomplete="off">
                            
                            <option value="0">Color de Vehiculo</option>
                            <?php
                                $selec = "SELECT * FROM color";
                                $inser = mysqli_query($mysqli,$selec);
                                while($tip = mysqli_fetch_array($inser)){
                            ?>
                            <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                    </div>
                    <div class="texto">

                        <label class="title">Anotaciones</label><br>
                        <textarea class="anota" name="anotaciones">
                        </textarea><br>

                    </div>
                    <div class="archivos">
                        <h2>Cargue los siguiente Documentos</h2>
                        <div class="form">
                              
                                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                <input type="hidden" name="sooat" value="30000" />
                                <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                Subir SOAT: <input name="sooat" type="file" /> <br>
                            
                        
                                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                <input type="hidden" name="tecno" value="30000" />
                                <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                Archivo de la Tecnomecanica: <input name="tecno" type="file" /> <br>
                            
                        
                                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                <input type="hidden" name="vehic" value="30000" />
                                <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                Imagen del Vehiculo: <input name="vehic" type="file" />                            
                        </div><br>
                    </div>
                <div class="button">                   
                <!--    <input type="submit" class="btn" name="registro" value="Crear"> -->
                    <input type="submit" class="btn" value="crear" name="registro">
                    
                </div>            
                
            </form>       
            
        </div>
    </div>
        </div>
    </div>
       
  
    
</body>
</html>