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
	<link rel="stylesheet" href="../css/editar.css">
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


   </section>

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
    <!-- Scripts cambiables -->
 
    <!--====== Scripts pagina ¡¡NO CAMBIAR!! -->
    <script src="../../../layout/js/jquery-3.1.1.min.js"></script>
    <script src="../../../layout/js/sweetalert2.min.js"></script>
    <script src="../../../layout/js/bootstrap.min.js"></script>
    <script src="../../../layout/js/material.min.js"></script>
    <script src="../../../layout/js/ripples.min.js"></script>
    <script src="../../../layout/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../layout/js/main.js"></script>
    <script>
        $.material.init();
    </script>

</html>

<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>
