<?php
	include_once("../../../php/conexion.php");

	include_once("PHPMailer/correo.php");

	
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
	<meta name="viewport" >
	<link rel="icon" href="../../../img/logo.ico"/>
    	<!-- estilos generales -->
	<link rel="stylesheet" href="../../../layout/css/main.css">
	<link rel="stylesheet" href="css/estilos.css">
	<!-- Tipo de letra -->
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				<img src="../../../img/Logo_parking_2.0.png" alt="logo" class="logo" style="width: 150px; height: 70px; display: flex; justify-content: center; margin-left:40px;">
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
				<?php

				$sql = "SELECT * FROM usuario WHERE id_tip_usu = 1";
				$result = mysqli_query($mysqli, $sql);
				while ($row2 = mysqli_fetch_array($result)) {
					/*almacenamos el nombre de la ruta en la variable $ruta_img*/
					$ruta_img = $row2["foto"];
				}
				?>
				<img src="../perfil/fotos/<?php echo $ruta_img; ?>" class="imagen" alt="">
					<!-- <img src="../../../img/foto_perfil.png" alt="UserIcon"> -->
					<div class="text-center text-titles">
						<p class="profile_welcome">Bienvenido,</p>
						<p class="profile_name">
							<?php echo $_SESSION['nom']," ", $_SESSION['ape']?>
						</p>
					</div>
				
				</figure>
				
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="../perfil/perfil.php">
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
					<a href="../home/administrador.php">
						<i class="fas fa-home"></i> Inicio 
					</a>
				</li>
				
				<li>
					<a href="../zonas/zona.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-plus" aria-hidden="true"></i> Crear zonas 
					</a>
					
				</li>
				<li>
					<a href="../usuarios/usuarios.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-users" aria-hidden="true"></i> Crear usuarios 
					</a>
					
				</li>
				<li>
					<a href="../crear/crearusu.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-car" aria-hidden="true"></i> Registro de vehiculos
					</a>
					
				</li>
				<li>
					<a href="../parqueo/parqueo.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-sign-in-alt" aria-hidden="true"></i> Reporte de entradas
					</a>
				</li>
				<li>
					<a href="../reporte_vehiculo/reporte.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-car" aria-hidden="true"></i> Reporte vehiculos
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
					<a href="#!" class="btn-modal-help">
						<i class="far fa-question-circle"></i>
					</a>
				</li>
                
                <a class="pull-left links" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a>   
               
                <a class="pull-left links" style="width: 170px;"  href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>
              
			</ul>    
		</nav>
		<!-- Aquí va el contenido -->
		
	<div class="conteiner">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center text-uppercase">USUARIOS</h1>
		</div>
	</div>
	<!-- BOTONOES DE REGISTRO -->
	<div class="registro btn-group" role="group" aria-label="Basic example" style="align-items:center;">
		<a onclick="bajar2();" class="but btn btn-primary" type="submit"><i class="fas fa-user-plus"> Registrar Usuarios Regulares</i></a>
		<a onclick="bajar();" class="but btn btn-primary" type="submit"><i class="fas fa-user-plus"> Registrar Administrativos</i></a>
		<a href="php/registrar_tipdoc.php" class="but btn btn-primary" type="submit"><i class="fas fa-plus-circle"> Resgistrar tipos de Documento</i></a>
		<a href="php/registrar_tipusu.php" class="but btn btn-primary" type="submit"><i class="fas fa-plus-circle"> Resgistrar tipos de Usuario</i></a>
		
	</div>

	
<!-- registro de usuarios administrativos  -->
<div class="container">
			<div id="registro" class="col-sm-12 col-md-12 col-lg-12 ocultar">
				<div class="form-group">
						<h3 class="col-sm-offset-2 col-sm-8 text-center">					
						Formulario de Registro de Administrativos</h3>
				</div>
					<br><br><br>
				<form class="form-horizontal" action="" method="POST" onsubmit="return validacion2()">
					
					<!-- tipo de usuario -->
					<div class="form-group">
						<label for="cor" class="col-sm-2 control-label">Tipo de usuarios</label>
						<div class="col-sm-8">
								<select id="tip_usu" name="tipo_usuario" class="form-control">
								<!-- consultas y codigo para validar que los registros esten el la bd y guardarlos en una lista -->
											<option value="">Seleccione</option>
											<?php
												$sql="SELECT*FROM tipo_usuario WHERE id_categoria = 6";
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
					</div>
					<!-- tipo de documento -->
					<div class="form-group">
						<label for="cor" class="col-sm-2 control-label">Tipo de documento</label>
						<div class="col-sm-8">
								<select id="tip_docu" name="tipo_documento" class="form-control">
								<!-- consultas y codigo para validar que los registros esten el la bd y guardarlos en una lista -->
									<option value="">Seleccione</option>
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
					</div>
					<div class="form-group">
						<label for="doc" class="col-sm-2 control-label">Documento</label>
						<div class="col-sm-8"><input id="doc" name="doc" type="number" class="form-control" maxlength="11" autocomplete="off" autofocus></div>
					</div>
						<?php 

							function aleatorioCode($length = 6) { 
    							return substr(str_shuffle("0123456789"), 0, $length); 
							} 
							$aleatorio  = aleatorioCode();					

						?>


					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Codigo</label>
						<div class="col-sm-8"><input id="code" name="code" type="number" value="<?php echo $aleatorio;?>" class="form-control" maxlength="11" autocomplete="off"></div>
					</div>	
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nombres</label>
						<div class="col-sm-8"><input id="nom" name="nom" type="text" class="form-control" autocomplete="off"></div>				
					</div>
					<div class="form-group">
						<label for="ape" class="col-sm-2 control-label">Apellidos</label>
						<div class="col-sm-8"><input id="ape" name="ape" type="text" class="form-control" autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="ed" class="col-sm-2 control-label">Edad</label>
						<div class="col-sm-8"><input id="ed" name="ed" type="number" class="form-control" maxlength="2" autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="celu" class="col-sm-2 control-label">Celular</label>
						<div class="col-sm-8"><input id="celu" name="celu" type="number" class="form-control" maxlength="10"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="direc" class="col-sm-2 control-label">Dirección</label>
						<div class="col-sm-8"><input id="direc" name="direc" type="text" class="form-control" maxlength="50"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="cor" class="col-sm-2 control-label">Correo</label>
						<div class="col-sm-8"><input id="cor" name="cor" type="email" class="form-control" maxlength="50"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="clave" class="col-sm-2 control-label">Contraseña</label>
						<div class="col-sm-8"><input id="clave" name="clave" type="password" class="form-control" autocomplete="off"></div>
					</div>	
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<input type="submit" class="btn btn-primary" value="Registrar">
							<input type="hidden" name="registrar" value="registrar_usuario">
							<input onclick="listar();" type="button" class="btn btn-success" value="Listar">
						</div>
					</div>
				</form>
			</div>
			<!-- CODIGO PHP PARA REGISTRAR USUARIOS -->
                <?php   
					
                    if(isset($_POST['registrar'])){
                        $documento=$_POST['doc'];
						$codigo=$_POST['code'];
                        $nombre=$_POST['nom'];
                        $apellido=$_POST['ape'];
                        $edad=$_POST['ed'];
                        $celular=$_POST['celu'];
                        $direccion=$_POST['direc'];
                        $correo=$_POST['cor'];
                        $clave=$_POST['clave'];
                        $tip_usu=$_POST['tipo_usuario'];
                        $tip_docu=$_POST['tipo_documento'];

						
						if($tip_usu == 1){
							$sql="INSERT INTO usuario (documento, codigo, nombre, apellido, edad, celular, direccion,correo, clave, id_tip_usu,id_tip_doc,id_estado) VALUES ('$documento', '$codigo','$nombre','$apellido','$edad','$celular','$direccion','$correo','$clave','$tip_usu','$tip_docu',10)";
							
						}else{
							$sql="INSERT INTO usuario (documento, codigo, nombre, apellido, edad, celular, direccion,correo, clave, id_tip_usu,id_tip_doc,id_estado) VALUES ('$documento', '$codigo','$nombre','$apellido','$edad','$celular','$direccion','$correo','$clave','$tip_usu','$tip_docu',6)";
							
						}
						
                           
                        $resul=mysqli_query($mysqli,$sql);
                            
                        if(!$resul){  
							echo "<script language='JavaScript'>
										alert('Se ha creado el usuario correctamente'); 
								  </script>";  
								  
							correo($correo,$codigo, $nombre);
						}
						else{
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
</div>
<!-- registro de usuarios rregulares -->
<div class="container">
			<div id="registro2" class="col-sm-12 col-md-12 col-lg-12 ocultar">
				<form class="form-horizontal" action="" method="POST" onsubmit="return validacion()">
					<div class="form-group">
						<h3 class="col-sm-offset-2 col-sm-8 text-center">					
						Formulario de Registro de Usuarios Regulares</h3>
					</div>
					<!-- tipo de usuario -->
					<div class="form-group">
						<label class="col-sm-2 control-label" >Tipo de usuario</label>
							<div class="col-sm-8">
								<select id="select_tip_user" name="tipo_usuario" class="form-control">
								<!-- consultas y codigo para validar que los registros esten el la bd y guardarlos en una lista -->
											<option value="">Seleccione</option>
											<?php
												$sql="SELECT*FROM tipo_usuario WHERE id_categoria = 7";
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
					</div>
					<!-- tipo de documento -->
					<div class="form-group">
						<label for="cor" class="col-sm-2 control-label">Tipo de documento</label>
						<div class="col-sm-8">
								<select id="select_tip_doc" name="tipo_documento" class="form-control">
								<!-- consultas y codigo para validar que los registros esten el la bd y guardarlos en una lista -->
									<option value="">Seleccione</option>
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
					</div>
					<div class="form-group">
						<label for="doc" class="col-sm-2 control-label">Documento</label>
						<div class="col-sm-8"><input id="docu" name="doc" type="number" class="form-control" maxlength="11" autocomplete="off" autofocus></div>
					</div>
						<?php 

							function aleatorioCode2($length = 6) { 
    							return substr(str_shuffle("0123456789"), 0, $length); 
							} 
							$aleatorio2  = aleatorioCode2();					

						?>


					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Codigo</label>
						<div class="col-sm-8"><input id="code" name="code" type="number" value="<?php echo $aleatorio2;?>" class="form-control" maxlength="11" autocomplete="off" autofocus></div>
					</div>

					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nombres</label>
						<div class="col-sm-8"><input id="nomb" name="nom" type="text" class="form-control" autocomplete="off"></div>				
					</div>
					<div class="form-group">
						<label for="ape" class="col-sm-2 control-label">Apellidos</label>
						<div class="col-sm-8"><input id="apel" name="ape" type="text" class="form-control" autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="ed" class="col-sm-2 control-label">Edad</label>
						<div class="col-sm-8"><input id="eda" name="ed" type="number" class="form-control" maxlength="2" autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="celu" class="col-sm-2 control-label">Celular</label>
						<div class="col-sm-8"><input id="celuc" name="celu" type="number" class="form-control" maxlength="10"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="direc" class="col-sm-2 control-label">Direccion</label>
						<div class="col-sm-8"><input id="direci" name="direc" type="text" class="form-control" maxlength="50"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<label for="cor" class="col-sm-2 control-label">Correo</label>
						<div class="col-sm-8"><input id="core" name="cor" type="email" class="form-control" maxlength="50"  autocomplete="off"></div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<input type="submit" class="btn btn-primary" value="Registrar">
							<input type="hidden" name="registrar2" value="registrar_usuario">
							<input onclick="listar();" type="button" class="btn btn-success" value="Listar">
						</div>
					</div>
				</form>
			</div>
			<!-- CODIGO PHP PARA REGISTRAR USUARIOS -->
                <?php   
                    if(isset($_POST['registrar2'])){
                        $documento=$_POST['doc'];
						$codigo=$_POST['code'];
                        $nombre=$_POST['nom'];
                        $apellido=$_POST['ape'];
                        $edad=$_POST['ed'];
                        $celular=$_POST['celu'];
                        $direccion=$_POST['direc'];
                        $correo=$_POST['cor'];
                        $tip_usu=$_POST['tipo_usuario'];
                        $tip_docu=$_POST['tipo_documento'];
						
                        
							$sql="INSERT INTO usuario (documento, codigo, nombre, apellido, edad, celular, direccion,correo, id_tip_usu,id_tip_doc,id_estado) VALUES ('$documento', '$codigo','$nombre','$apellido','$edad','$celular','$direccion','$correo','$tip_usu','$tip_docu',6)";
							$resul=mysqli_query($mysqli,$sql);

						if($resul){
							echo "<script language='JavaScript'>
										alert('Se ha creado el usuario correctamente'); 
								  </script>";  

								  correo($correo,$codigo,$nombre);
								  
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
</div>
	<div class="contenedor conteiner">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12 ocultar">
			<form id="form" class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">					
					Formulario de Edicion de Usuarios</h3>
				</div>
				<!-- <input type="hidden" id="documento" name="documento" value="0"> -->
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<div class="form-group">
					<label for="documento" class="col-sm-2 control-label">Documento</label>
					<div class="col-sm-8"><input id="documento" name="documento" type="text" class="form-control" maxlength="11"></div>
				</div>
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombres</label>
					<div class="col-sm-8"><input id="nombre" name="nombre" type="text" class="form-control" disabled></div>				
				</div>
				<div class="form-group">
					<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
					<div class="col-sm-8"><input id="apellido" name="apellido" type="text" class="form-control" disabled></div>
				</div>
				<div class="form-group">
					<label for="edad" class="col-sm-2 control-label">Edad</label>
					<div class="col-sm-8"><input id="edad" name="edad" type="text" class="form-control" maxlength="2" autofocus></div>
				</div>
				<div class="form-group">
					<label for="celular" class="col-sm-2 control-label">Celular</label>
					<div class="col-sm-8"><input id="celular" name="celular" type="text" class="form-control" maxlength="10"></div>
				</div>
				<div class="form-group">
					<label for="direccion" class="col-sm-2 control-label">Direccion</label>
					<div class="col-sm-8"><input id="direccion" name="direccion" type="text" class="form-control" maxlength="50"></div>
				</div>
				<div class="form-group">
					<label for="correo" class="col-sm-2 control-label">Correo</label>
					<div class="col-sm-8"><input id="correo" name="correo" type="text" class="form-control" maxlength="50"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="" type="submit" class="btn btn-primary" value="Guardar">
						<input id="btn_listar" type="button" class="btn btn-success" value="Listar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
			
		</div>
	</div>

<!-- tabla donde se listan los usuarios -->
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="tabla_usu" class="table table-bordered table-hover" cellspacing="0" width="100%" >
					<thead>
						<tr>								
							<th>Documento</th>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>edad</th>
							<th>Celular</th>
							<th>Direccion</th>
							<th>Correo</th>
							<th>T. Documento</th>
							<th>T. Usuario</th>
							<th>T. Estado</th>
							<th>Acciones</th>											
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
		
</section>

<!-- Dialog help -->
    <div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ayuda!!</h4>
                </div>
                <div class="modal-body">
                    <p>
                       Hola querido usuario, Bienvenido!! <br>
                       Aqui encontraras los manuales que te podran ayudar a saber el funcionamiento de nuestra pagina y los manuales son los siguientes: <br>

                       <a href="https://drive.google.com/file/d/1H_dSFSHAyf4bWmgumzvoaixI6uW7P6A3/view?usp=sharing">Manual de Usuarios</a> <br>
                       <a href="https://drive.google.com/file/d/1dfh-e8XFyhJfa4qRkmCpH0x2e9evBs34/view?usp=sharing">Manual tecnico</a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Ok <i
                            class="fas fa-exclamation"></i> </button>
                </div>
            </div>
        </div>
    </div>

	<div>
		<form id="frmEliminarUsuario" action="" method="POST">
			<input type="hidden" id="documento" name="documento" value="">
			<input type="hidden" id="opcion" name="opcion" value="eliminar">
			<!-- Modal -->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
						</div>
						<div class="modal-body">							
							¿Está seguro de eliminar al usuario?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>
<!--====== Scripts pagina cambiables -->

	<script src="js/validacion.js"></script>
	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="js/dataTables.buttons.min.js"></script>
	<script src="js/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="js/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="js/pdfmake.min.js"></script>
	<script src="js/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="js/buttons.html5.min.js"></script>

<script>		
		$(document).on("ready", function(){
			listar();
			guardar();
			eliminar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		var guardar = function(){
			$("#form").on("submit", function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
				console.log( info );		
					var json_info = JSON.parse( info );
					mostrar_mensaje( json_info );
					limpiar_datos();
					listar();
				});
			});
		}

		
		var eliminar = function () {
				$("#eliminar-usuario").on("click", function () {
					var documento = $("#frmEliminarUsuario #documento").val(),
						opcion = $("#frmEliminarUsuario #opcion").val();
					$.ajax({
						method: "POST",
						url: "guardar.php",
						data: { "documento": documento , "opcion": opcion }
					}).done(function ( info ){
						var json_info = JSON.parse( info );
						mostrar_mensaje( json_info );
						limpiar_datos();
						listar();
					});
				});
			}

		var mostrar_mensaje = function( informacion ){
			var texto = "", color = "";
			if( informacion.respuesta == "BIEN!" ){
					texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
					color = "#379911";
			}else if( informacion.respuesta == "ERROR!"){
					texto = "<strong>Error</strong>, no se ejecutó la consulta.";
					color = "#C9302C";
			}else if( informacion.respuesta == "EXISTE" ){
					texto = "<strong>Información!</strong> el usuario ya existe.";
					color = "#5b94c5";
			}else if( informacion.respuesta == "VACIO" ){
					texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
					color = "#ddb11d";
			}else if( informacion.respuesta == "OPCION_VACIA" ){
					texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
					color = "#ddb11d";
			}

			$(".mensaje").html( texto ).css({"color": color });
			$(".mensaje").fadeOut(5000, function(){
					$(this).html("");
					$(this).fadeIn(3000);
			});			
		}

		var limpiar_datos = function(){
			$("#opcion").val("registrar");
			$("#documento").val("").focus();
			$("#nombre").val("");
			$("#apellido").val("");
			$("#edad").val("");
			$("#celular").val("");
			$("#direccion").val("");
			$("#correo").val("");
			$("#tipdoc").val("");
			$("#tipusu").val("");
			$("#estausu").val("");
			
		}

		var listar = function(){
			$("#cuadro1").slideDown("slow");
			$("#cuadro2").slideUp("slow");
			$("#registro").slideUp("slow");
			$("#registro2").slideUp("slow");
			var table = $("#tabla_usu").DataTable({
				"destroy":true,
				"ajax":{
					"method":"POST",
					"url": "listar.php"
				},
				"columns":[
					{"data": "documento" },
					{"data": "codigo" },
					{"data":"nombre"},
					{"data":"apellido"},
					{"data":"edad"},
					{"data":"celular"},
					{"data":"direccion"},
					{"data":"correo"},
					{ "data": "nom_tip_doc" },
					{ "data": "nom_tip_usu" },
					{ "data": "nom_estado" },
					{"defaultContent": "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button> <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}	
				],
				"language": idioma_espanol,
				"lengthMenu":[[2,5,10,50,-1],[2,5,10,50,"Todos los"]],
				"dom": 'lfrtipB ',
                "buttons":[
					{
						//Botón para Excel
						extend: 'excel',
						footer: true,
						title: 'Archivo',
						filename: 'Usuarios Parqueadero',

						//Aquí es donde generas el botón personalizado
						text: '<button class="botones btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
					},
					//Botón para PDF
					{
						extend: 'pdf',
						footer: true,
						title: 'Archivo',
						filename: 'Usuarios Parqueadero',
						text: '<button class="botones btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
					}
					]
			});
			obtener_data_editar("#tabla_usu tbody", table);
			obtener_id_eliminar("#tabla_usu tbody", table);
		}


		var bajar = function(){
			limpiar_datos();
			$("#registro").slideDown("slow");
			$("#cuadro1").slideUp("slow");
			
		}

		
		var bajar2 = function(){
			limpiar_datos();
			$("#registro2").slideDown("slow");
			$("#cuadro1").slideUp("slow");
			
		}

		var obtener_data_editar = function(tbody, table){
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				var documento = $("#documento").val( data.documento ),
						nombre = $("#nombre").val( data.nombre ),
						apellidos = $("#apellido").val( data.apellido ),
						edad = $("#edad").val( data.edad ),
						celular = $("#celular").val(data.celular),
						direccion = $("#direccion").val(data.direccion),
						correo = $("#correo").val(data.correo),
						opcion = $("#opcion").val("modificar");
						$("#cuadro2").slideDown("slow");
						$("#cuadro1").slideUp("slow");
			});
		}

		
		var obtener_id_eliminar = function(tbody, table){
				$(tbody).on("click", "button.eliminar", function(){
					var data = table.row( $(this).parents("tr") ).data();
					var documento = $("#frmEliminarUsuario #documento").val( data.documento );
				});
			}

		var idioma_espanol = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
		

	</script>


<!--====== Scripts pagina ¡¡NO CAMBIAR!! -->
<script src="../../../layout/js/sweetalert2.min.js"></script>
<script src="../../../layout/js/main.js"></script>
<script src="../../../layout/js/jquery.mCustomScrollbar.concat.min.js"></script>

</body>
</html>
<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>