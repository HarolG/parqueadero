<?php
    include("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
        $tipoZona = $mysqli -> query ("SELECT id_zona, nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
        $zonas = $mysqli -> query ("SELECT id_zona,id_estado,nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
        
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="../../../img/logo.ico"/>
    <!-- estilos generales -->
	<link rel="stylesheet" href="../../../layout/css/main.css">
	<link rel="stylesheet" href="css/estilos.css">
	<!-- Tipo de letra -->
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
		rel="stylesheet">
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
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
                <img src="../../perfil/fotos/<?php echo $ruta_img; ?>" class="imagen" alt="">
					<!-- <img src="../../../img/foto_perfil.png" alt="UserIcon"> -->
					<div class="text-center text-titles">
						<p class="profile_welcome">Bienvenido,</p>
						<p class="profile_name">
							<?php echo $_SESSION['nom']," ", $_SESSION['ape']?>
						</p>
					</div>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="../perfil/perfil.php">
							<i class="fas fa-cogs" style="font-size: 20px;"></i>
						</a>
					</li>
					<li>
						<a href="#" class="btn-exit-system">
							<i class="fas fa-power-off" style="font-size: 20px;"></i>
						</a>
					</li>
			</ul>
				</figure>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="../home/administrador.php">
						<i class="fas fa-home" style="font-size: 16px;"></i> Inicio 
					</a>
				</li>
				<li>
					<a href="parqueo.php" class="btn-sideBar-SubMenu">
						<i class="fa fa-sign-in-alt" aria-hidden="true"></i> Reporte de entradas
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
                <a class="pull-left links" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a>   
               
                <a class="pull-left links" style="width: 170px;"  href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>
			</ul>    
		</nav>
            <!-- Aquí va el contenido -->
    
            <div class="ingreso">
                <div class="infoZonas">
                    <?php
                        while ($resul2 = mysqli_fetch_array($zonas)) {
                            $cupos_libres = $mysqli -> query ("SELECT * FROM detalle_cupos WHERE id_zona = '$resul2[id_zona]' AND id_estado_cupo = '1'");
                            $resul_cupos = $cupos_libres->num_rows;
                            
                            echo "
                                <div class='darosZonas'>
                                    <h2>ZONA $resul2[id_zona]</h2>
                                    <h3>$resul2[nom_tip_zona]</h3>
                                    <label>Cupos Disponibles: $resul_cupos</label>
                                </div>
                                    
                                ";
                            }
                        ?>
                    </div><hr style="background-color:#73879C;">
                <div class="filtro">
                    <form method="post" class = "formFiltro">
                        <h2>REPORTES</h2>
                        <strong style="color:black;">Zona de Parqueo:</strong>
                        <select class = "tipoZona" id="tipoZona" name="tipoZona">
                            <option selected>Seleccione una opción </option>
                            <option value="0">Todas</option>
                                    <?php
                                        while ($resul = mysqli_fetch_array($tipoZona)) 
                                        { echo "<option value=$resul[id_zona]>$resul[nom_tip_zona]</option>";}
                                    
                                    ?>
                        </select>

                        <strong style="color:black;">Reporte de: </strong>
                        <select id='reporte' class='reporte' name='reporte'>
                            <option value="0" selected>Seleccione una opción </option>
                            <option value='1'>Hoy</option>
                            <option value='2'>Ayer</option>
                            <option value='3'>Hace una semana</option>
                            <option value='4'>Hace un mes</option>
                        </select>

                        <input type="submit" name="buscar" style="color: black;"  class="btn btn-primary btnReporte" value="Generar">
                    </form>
                </div>
                <div class="lugar">
               
                <?php
                 if(@$_POST['buscar']){
                    date_default_timezone_set('America/Bogota');

                    $tip_zona = $_POST['tipoZona'];
                    $tip_repo = $_POST['reporte'];

                  
                  
                    //REPORTES
                    $fecha_actual = date("Y-m-d");
                    //resto 1 día
                    $reDia = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
                    //resto 7 día
                    $reWeek = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
                    //resto 30 día
                    $reMes = date("Y-m-d",strtotime($fecha_actual."- 30 days")); 

                    if ($tip_repo == 1){
                        $tip_repo = $fecha_actual;
                    }
                    elseif($tip_repo == 2){
                        $tip_repo = $reDia;
                        $fecha_actual = $reDia;
                    }
                    elseif($tip_repo == 3){
                        $tip_repo = $reWeek;
                    }else{
                        $tip_repo = $reMes;
                    }

                    //tipo de zona que desea ver
                    if($tip_zona == 0){
                    //ver todas las zonas
                        $entradas = $mysqli -> query ("SELECT vehiculo.placa, usuario.documento, usuario.nombre, usuario.apellido,usuario.celular, registro_parqueadero.hora, registro_parqueadero.fecha 
                                                    FROM usuario, vehiculo, registro_parqueadero 
                                                    WHERE usuario.documento = vehiculo.documento AND vehiculo.placa = registro_parqueadero.placa AND registro_parqueadero.fecha Between '$tip_repo' And '$fecha_actual'");
                                            
                    }else {
                        $entradas = $mysqli -> query ("SELECT vehiculo.placa, usuario.documento, usuario.nombre, usuario.apellido,usuario.celular, registro_parqueadero.hora, registro_parqueadero.fecha
                                                    FROM usuario, vehiculo, registro_parqueadero 
                                                    WHERE usuario.documento = vehiculo.documento AND vehiculo.placa = registro_parqueadero.placa AND registro_parqueadero.id_zona = '$tip_zona' and registro_parqueadero.fecha Between '$tip_repo' And '$fecha_actual'");
                    }

                   
                    $resul = $entradas->num_rows;
                    if ($resul > 0)
                    {
                        $tabla= 
                        '<div class="repo" >
                            <div class="tabla" id ="tabla">
                            <table>
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Doc. Propietario</th>
                                    <th>Nom. Propietario</th>
                                    <th>Tel</th>
                                    <th>Fecha</th>
                                    <th>H. Ingreso</th>
                                    <th>H. Salida</th>
                                    <th>H. Estadia</th>
                                </tr>
                            </thead>';
                    
                        while($fila = mysqli_fetch_array($entradas))
                        {
                        $placa = $fila['placa'];
                        
                        $tabla.=
                            " <tbody>
                                <tr>
                                    <td>$placa</td>
                                    <td>".$fila['documento']."</td>
                                    <td>".$fila['nombre']." ".$fila['apellido']." </td>
                                    <td>".$fila['celular']."</td>
                                    <td>".$fila['fecha']."</td>
                                    <td>".$fila['hora']."</td>";

                                    // Validar si el vehiculo ya salio del parqueadero
                                    $salida = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE placa = '$placa' and id_tip_entrada = 2");
                                   
                                    // Variable para hora de entrada del vehiculo
                                    $h_entrada = $fila['hora'];
                                    $resu = $salida->num_rows;
                                    if ($resu == 1){
                                        $infoSalida = mysqli_fetch_array($salida);
                                        $h_salida = $infoSalida['hora'];
                    
                                        $hora1 = new DateTime($h_entrada);//Hora de entrada
                                        $hora2 = new DateTime($h_salida);//Hora de salida
                    
                                        //rango de horas dentro del parqueadero
                                        $intervalo = $hora2->diff($hora1);
                                        $tiempoR = $intervalo->format('%H:%i:%s');
                                        $tabla.= "<td>$infoSalida[4]</td>
                                                <td>$tiempoR</td>";
                                        
                                    }else{
                                        $hora1 = new DateTime($h_entrada);//Hora de entrada
                                        $hora2 = new DateTime(date("H:i:s"));//Hora de actual
                                        
                                        //rango de horas dentro del parqueadero
                                        $intervalo = $hora1->diff($hora2);
                                        $tiempoR = $intervalo->format('%H:%i:%s');
                                        $tabla.= "<td>En el Parqueadero</td>
                                                <td>$tiempoR</td>";
                                    }
                        $tabla.='</tr>
                                </tbody>
                                        ';
                    
                        }

                    //Contenedor para mostrar la cantidad de registros de la consulta entradas linea 194 
                        $tabla.="   </table></div>
                                </div>
                                
                                <div class='numVehi' id= 'numVehi'>
                                    <h2>N° DE VEHICULOS INGRESADOS</h2>";
                                    if($tip_zona == 0){
                                        $tabla.="<strong class='num'>$resul</strong><img src='../../../img/logo.png' class='logo2'>";
                                    }
                                    elseif($tip_zona == 1){
                                        $tabla.="<i class='fas fa-car' style='font-size:65px;'><strong>$resul</strong></i>";
                                    }
                                    elseif($tip_zona == 2){
                                        $tabla.="<i class='fas fa-motorcycle' style='font-size:65px;'><strong>$resul</strong></i>";
                                    }else{
                                        $tabla.="<i class='fas fa-biking' style='font-size:65px;'><strong>$resul</strong></i>";
                                    }
                                     
                                $tabla.="</div> ";
                                } 
                                // Si la consulta entradas (linea 194) no arrojó ningun resultado
                                else
                                    {
                                        $tabla="<i id='error' class='fas fa-exclamation-triangle'  style='font-size:65px;'></i>
                                        <h3 class='sinDatos'>No se encontraron coincidencias con sus criterios de búsqueda.</h3>
                                        ";
                                    }
                        echo $tabla;
                    }
                ?>
                
                <div class="btn-group acciones">
                    <div class="btn btn-outline-danger btnImprimir" onclick="imprimir()">
                    <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="btn btn-outline-success btnExcel" onclick="exportTableToExcel('tabla', 'REPORTE_<?php echo date('d_m_Y');?>')" >
                        <i class="fas fa-file-excel"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
	<!-- Notifications area -->

	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
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
			    	<h4 class="modal-title">Help</h4>
			    </div>
			    <div class="modal-body">
			        <p>
			        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
			        </p>
			    </div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Ok <i class="fas fa-exclamation" ></i></button>
		      	</div>
		    </div>
	  	</div>
	</div>

</body>
    <!-- Scripts cambiables -->
    
    <script src="js/main.js"></script>

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
