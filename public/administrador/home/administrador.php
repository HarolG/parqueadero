<?php
    include_once("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
		
		$docu = $_SESSION['doc'];
		$datos_usu = $mysqli -> query ("SELECT * FROM usuario WHERE documento = '$docu'");
		$registro = mysqli_fetch_array($datos_usu);

		$id_estado_pass = $registro['id_estado_pass'];

		if($id_estado_pass == 10){
			echo '<script type="text/javascript">window.location.href="php/cambioPass.php";</script>';
		}

        #Consulta para obtener todos los datos de los vehiculos ingresados el día hoy
        $sql = "SELECT * FROM registro_parqueadero WHERE fecha = CURDATE() ORDER BY hora ASC";
        $query = mysqli_query($mysqli, $sql);
        $result = mysqli_fetch_array($query);

        #De aquí cuento cuantos vehiculos han entrado el día de hoy
        $vehiculos_parqueados = $query->num_rows;

        #Consulta para obtener los cupos de los vehiculos 
        $sql2 = "SELECT * FROM zona_parqueo, detalle_cupos WHERE zona_parqueo.id_zona = detalle_cupos.id_zona AND zona_parqueo.id_tip_zona = '1' AND detalle_cupos.id_estado = '4'";
        $query_carros = mysqli_query($mysqli, $sql2);

        #Defino la variable para los cupos
        $cupos_carros = 0;
        $cupos_motos = 0;
        $cupos_ciclas = 0;
    
        #En esta linea cuento el número de cupos disponibles para los carros
        $cupos_carros = mysqli_num_rows($query_carros);

        #Consulta para obtener los cupos de las motos
        $sql3 = "SELECT * FROM zona_parqueo, detalle_cupos WHERE zona_parqueo.id_zona = detalle_cupos.id_zona AND zona_parqueo.id_tip_zona = '2' AND detalle_cupos.id_estado = '4'";
        $query_motos = mysqli_query($mysqli, $sql3);
    
        #En esta linea cuento el número de cupos disponibles para las motos
        $cupos_motos = mysqli_num_rows($query_motos);

        #Consulta para obtener los cupos de las ciclas
        $sql4 = "SELECT * FROM zona_parqueo, detalle_cupos WHERE zona_parqueo.id_zona = detalle_cupos.id_zona AND zona_parqueo.id_tip_zona = '3' AND detalle_cupos.id_estado = '4'";
        $query_ciclas = mysqli_query($mysqli, $sql4);

		#En esta linea cuento el número de cupos disponibles para las motos
        $cupos_ciclas = mysqli_num_rows($query_ciclas);
    

?>
<!-- codigo de harold -->
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" href="../../../img/logo.ico" />
	<!-- estilos generales -->
	<link rel="stylesheet" href="../../../layout/css/main.css">
	<link rel="stylesheet" href="css/administrador.css">
	<!-- Tipo de letra -->
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
		rel="stylesheet">
	<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
</head>

<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				<img src="../../../img/Logo_parking_2.0.png" alt="logo" class="logo"
					style="width: 150px; height: 70px; display: flex; justify-content: center; margin-left:40px;">
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
						<?php

                            $sql = "SELECT * FROM usuario WHERE id_tip_usu = 1";
                            $result = mysqli_query($mysqli,$sql);
                            while ($row2=mysqli_fetch_array($result))
                            {
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
					<a href="administrador.php">
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

				<a class="pull-left links" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de
					Industria y Construcción</a>

				<a class="pull-left links" style="width: 170px;"
					href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>

			</ul>
		</nav>
		<!-- Aquí va el contenido -->
		<div class="datos_parqueo-container">
			<div class="dato_container">
				<small> <i class="fas fa-car"></i> Entradas al Parqueadero Hoy</small>
				<div class="container_conteo">
					<p><?php print($vehiculos_parqueados); ?></p>
				</div>
			</div>
			<div class="dato_container">
				<small><i class="fa fa-bicycle" aria-hidden="true"></i> Cupos Disponibles Bicicletas</small>
				<div class="container_conteo">
					<p><?php print($cupos_ciclas);?></</p> </div> </div> <div class="dato_container">
						<small><i class="fas fa-car-side"></i> Cupos Disponibles Carros</small>
						<div class="container_conteo">
							<p><?php print($cupos_carros);?></p>
						</div>
				</div>
				<div class="dato_container">
					<small><i class="fa fa-motorcycle" aria-hidden="true"></i> Cupos Disponibles Motos</small>
					<div class="container_conteo">
						<p><?php print($cupos_motos);?></p>
					</div>
				</div>
			</div>
			<div class="grafica_historia_parqueo container">
				<h2 style="font-weight: bold; color:black;">Actividad del Parqueadero</h2>
				<div class="row">
					<div class="col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="grafica_container">
									<form id="formZonas">
										<label for="zona" style="font-weight: bold; color:black;">Seleccione la
											Zona</label>
										<select name="zona" id="zona">
											<?php
                                    			#Esta consulta trae todas las zonas que existen el parqueadero
                                    			$zonasSql = "SELECT id_zona FROM zona_parqueo";
                                    			$queryZonas = mysqli_query($mysqli, $zonasSql);

                                    			while ($row = mysqli_fetch_array($queryZonas)) {
                                			?>
											<option value="<?php print($row["id_zona"]);?>">Zona
												<?php print($row["id_zona"]);?></option>
											<?php
                                    		}
                                			?>
											<input class="btn btn-secondary" type="submit" value="Generar">
										</select>
									</form>
									<!-- En este div se genera la gráfica -->
									<div id="graficaHistoria" class="graficaHistoria"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="info_zonas">
									<h2 style="font-weight: bold; color:black;">Información de la zona</h2>
									<div class="informacion_zona" id="informacion_zona"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ayuda!!</h4>
                </div>
                <div class="modal-body">
					<p>Documento del que ingresó: <?php echo ($docu);?></p>
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

</body>
<!-- Scripts cambiables -->
<!-- Libreria para crear gráficas -->
<script src="../../../library/plotly-latest.min.js"></script>

<!-- Librería que voy a quitar -->
<script src="../../../library/jquery-3.6.0.min.js"></script>

<!-- Javascript general -->
<script src="js/graficas.js"></script>


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