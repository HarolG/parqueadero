<?php
    include("../../../../php/conexion.php");
    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
?> 

<!-- 
Importante,
Esto es solo una plantilla
En caso de que las imagenes no se inserten, o los estilos no se inserten
Favor revisar los direccionamientos 
-->
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="../../../img/logo.ico"/>
    <!-- estilos generales -->
	<link rel="stylesheet" href="../../../../layout/css/main.css">
	
	<!-- Tipo de letra -->
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
		function confirmar(){
			return confirm('¿Estas Seguro? se eliminaran los datos y no podras restaurarlos');

		}

</script>
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				<img src="../../../../img/Logo_parking_2.0.png" alt="logo" class="logo" style=" width: 150px; height: 70px; display: flex; justify-content: center; margin-left:40px;">
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="../../../../img/foto_perfil.png" alt="UserIcon">
					<div class="text-center text-titles">
						<p class="profile_welcome">Bienvenido,</p>
						<p class="profile_name">
							<?php echo $_SESSION['nom']," ", $_SESSION['ape']?>
						</p>
					</div>
				
				</figure>
				
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="fas fa-cogs"></i>
						</a>
					</li>
					<li>
						<a href="#" class="btn-exit-system">
							<i class="fas fa-power-off"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="../../home/administrador.php">
						<i class="fas fa-home"></i> Inicio 
					</a>
				</li>
				<li>
					<a href="../../parqueo/parqueo.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-sign-in-alt" aria-hidden="true"></i> Reporte de entradas
					</a>
					
				</li>
				<li>
					<a href="../../zonas/zona.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-plus" aria-hidden="true"></i> Crear zonas 
					</a>
					
				</li>
				<li>
					<a href="../../usuarios/usuarios.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-users" aria-hidden="true"></i> Crear usuarios 
					</a>
					
				</li>
				<li>
					<a href="../../crear/crearusu.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-car" aria-hidden="true"></i> Registro de vehiculos
					</a>
					
				</li>
			</ul>
		</div>
	</section>

	<!-- barra de menus-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</li>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="far fa-envelope"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="far fa-question-circle"></i>
					</a>
				</li>
                
                <a class="pull-left" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a>   
               
                <a class="pull-left" style="width: 170px;"  href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>
              
			</ul>    
		</nav>
        <!-- Aquí va el contenido -->
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
	<!-- Notifications area -->

	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area">

		</div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notifications <i class="fas fa-times-circle btn-Notifications-area"></i>
			</div>
			<div class="list-group">
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-triangle"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">17m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-octagon"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">15m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
				    </div>
			  	</div>
			  	<div class="list-group-separator"></div>
				<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-help"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">10m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
				</div>
			  	<div class="list-group-separator"></div>
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-info"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">8m</div>
				      	<h4 class="list-group-item-heading">Tile with a label</h4>
				      	<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
				    </div>
			  	</div>
			</div>

		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title">Help!!</h4>
			    </div>
			    <div class="modal-body">
			        <p>
			        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
			        </p>
			    </div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Ok <i class="fas fa-exclamation"></i> </button>
		      	</div>
		    </div>
	  	</div>
	</div>

</body>
        
        <!--====== Scripts pagina ¡¡NO CAMBIAR!! -->
        <script src="../../../../layout/js/jquery-3.1.1.min.js"></script>
        <script src="../../../../layout/js/sweetalert2.min.js"></script>
        <script src="../../../../layout/js/bootstrap.min.js"></script>
        <script src="../../../../layout/js/material.min.js"></script>
        <script src="../../../../layout/js/ripples.min.js"></script>
        <script src="../../../../layout/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../../../../layout/js/main.js"></script>
        <script>
            $.material.init();
        </script>

<!-- Scripts cambiables -->
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
    
</html>   
<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>
