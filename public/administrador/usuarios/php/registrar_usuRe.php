<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Regulares</title>
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
						<div class="col-sm-8"><input id="code" name="code" type="password" value="<?php echo $aleatorio2;?>" class="form-control" maxlength="11" autocomplete="off" autofocus></div>
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
</body>
</html>