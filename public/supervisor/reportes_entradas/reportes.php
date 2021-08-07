<?php
include("../../../php/conexion.php");

if (isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass'])) {
    $tipoZona = $mysqli -> query ("SELECT id_zona, nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
    $zonas = $mysqli -> query ("SELECT id_zona,id_estado,nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>Reportes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="icon" href="../../../img/logo.ico" />
        <!-- estilos generales -->
        <link rel="stylesheet" href="../../../layout/css/main.css">
        <link rel="stylesheet" href="../../administrador/parqueo/css/estilos.css">
        <!-- Tipo de letra -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
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

                                $sql = "SELECT * FROM usuario WHERE id_tip_usu = 3";
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
                        <a href="../home/home.php">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="../mensajeria/buzon.php">
                            <i class="far fa-envelope"></i>  Buzón de mensajeria
                        </a>
                    </li>
                    <li>
                        <a href="../gestion/index.php">
                            <i class="fas fa-users-cog"></i> Gestión de Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="../gestion_parqueadero/home.php">
                            <i class="fa fa-sign-in-alt"></i> Gestión del Parqueadero
                        </a>
                    </li>
                    <li>
                        <a href="../reportes/reportes.php">
                            <i class="fa fa-sign-in-alt"></i> Reportes
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <!-- barra de menus-->
        <section class="full-box dashboard-contentPage">
        <?php
        $s2 = "SELECT * FROM mensajes WHERE leido = 1";
        $resul2=mysqli_query($mysqli,$s2);
        $row2=mysqli_num_rows($resul2);
        ?>
            <!-- NavBar -->
        <nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</li>
                <a class="btn-group ventana"><button type="button" class="open-modal" data-open="modal1"><i class="fas fa-eye" aria-hidden="true"></i></button></a>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="far fa-envelope"></i>
						<span class="badge"><?php echo $row2; ?></span>
					</a>
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
            <div class="ingreso">
               <hr style="background-color:#73879C;">
                <div class="modal" id="modal1" data-animation="slideInOutLeft">
                    <div class="modal-dialog">
                        <h2>Cupos disponibles</h2>
                        <header class="modal-header">

                            <div class="infoZonas">
                            <?php
                                while ($resul2 = mysqli_fetch_array($zonas)) {
                                    $cupos_libres = $mysqli -> query ("SELECT * FROM detalle_cupos WHERE id_zona = '$resul2[id_zona]' AND id_estado = '4'");
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
                            </div>                            
                            <button class="close-modal" aria-label="close modal" data-close>✕</button>
                        </header>
                </div>
            </div>
            <div class="filtro">
                    <form method="post" class = "formFiltro">
                        <h2>REPORTES</h2>
                        <strong style="color:black;">Zona de Parqueo:</strong>
                        <select class = "tipoZona" id="tipoZona" name="tipoZona" required>
                            <option selected>Seleccione una opción </option>
                            <option value="0">Todas</option>
                                    <?php
                                        while ($resul = mysqli_fetch_array($tipoZona)) 
                                        { echo "<option value=$resul[id_zona]>$resul[nom_tip_zona]</option>";}
                                    
                                    ?>
                        </select>&nbsp;
                        <strong style="color:black;">Reporte de: </strong>
                            <select id='reporte' class='reporte' name='reporte'>
                            <option value="0" selected>Seleccione una opción </option>
                            <option value='1'>Hoy</option>
                            <option value='2'>Ayer</option>
                            <option value='3'>Hace una semana</option>
                            <option value='3'>Hace un mes</option>
                        </select> 

                        <input type="submit" name="buscar" id="buscar" style="color: black;"  class="btn btn-primary btnReporte" value="Generar">
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
                    //resto 7 días
                    $reWee = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
                    //resto 30 días
                    $reMonth = date("Y-m-d",strtotime($fecha_actual."- 30 days")); 
                    

                    if ($tip_repo == 1){
                        $tip_repo = $fecha_actual;
                    }
                    elseif($tip_repo == 2){
                        $tip_repo = $reDia;
                        $fecha_actual = $reDia;

                    }elseif($tip_repo == 3){
                        $tip_repo = $reWee;
                        
                    }elseif($tip_repo == 4){
                        $tip_repo = $reMonth;
                        
                    }else{
                        echo("No selecciono ninguna opcion");
                    }
                    //tipo de zona que desea ver
                    if($tip_zona == 0){
                        //ver todas las zonas
                        $entradas = $mysqli -> query ("SELECT registro_parqueadero.id_registro, detalle_vehiculo.id_deta_vehiculo, vehiculo.placa, usuario.documento, usuario.nombre, usuario.apellido,usuario.celular, registro_parqueadero.hora,   registro_parqueadero.hora_salida, registro_parqueadero.fecha 
                                                        FROM usuario, vehiculo, registro_parqueadero, detalle_vehiculo 
                                                        WHERE usuario.documento = detalle_vehiculo.documento AND vehiculo.placa = detalle_vehiculo.placa AND detalle_vehiculo.id_deta_vehiculo = registro_parqueadero.id_deta_vehiculo AND registro_parqueadero.fecha Between '$fecha_actual' AND '$tip_repo'");
                                                
                    }else {
                        $entradas = $mysqli -> query ("SELECT registro_parqueadero.id_registro, detalle_vehiculo.id_deta_vehiculo, vehiculo.placa, usuario.documento, usuario.nombre, usuario.apellido,usuario.celular, registro_parqueadero.hora,   registro_parqueadero.hora_salida, registro_parqueadero.fecha 
                            FROM usuario, vehiculo, registro_parqueadero, detalle_vehiculo 
                            WHERE usuario.documento = detalle_vehiculo.documento AND vehiculo.placa = detalle_vehiculo.placa AND detalle_vehiculo.id_deta_vehiculo = registro_parqueadero.id_deta_vehiculo AND registro_parqueadero.id_zona = '$tip_zona' AND registro_parqueadero.fecha Between '$fecha_actual' AND '$tip_repo'");
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
                                        <th class="cabera">Placa</th>
                                        <th class="cabera">Doc. Propietario</th>
                                        <th class="cabera">Nom. Propietario</th>
                                        <th class="cabera">Tel</th>
                                        <th class="cabera">Fecha</th>
                                        <th class="cabera">H. Ingreso</th>
                                        <th class="cabera">H. Salida</th>
                                        <th class="cabera">H. Estadia</th>
                                        <th class="cabera">Zona</th>
                                        <th class="cabera">Cupo</th>
                                    </tr>
                                </thead>';
                        
                            while($fila = mysqli_fetch_array($entradas))
                            {
                            $placa = $fila['placa'];
                            $id_deta_vehiculo = $fila['id_deta_vehiculo'];
                            $id_registro = $fila['id_registro'];
                            $fecha = date_create($fila['fecha']);

                            $formato = date_format($fecha, "d-m-Y");
                            
                            $tabla.=
                                " <tbody>
                                    <tr>
                                        <td>$placa</td>
                                        <td>".$fila['documento']."</td>
                                        <td>".$fila['nombre']." ".$fila['apellido']." </td>
                                        <td>".$fila['celular']."</td>
                                        <td>$formato</td>
                                        <td>".$fila['hora']."</td>;
                                        <td>".$fila['hora']."</td>;
                                        <td>".$fila['hora']."</td>";

                                        
                                        // Validar si el vehiculo ya salio del parqueadero
                                        
                                        $registro = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE id_registro = '$id_registro'");
                                        $id_estado =  mysqli_fetch_array($registro);

                                        $estado = $id_estado['id_estado'];
                                        $h_entrada = $fila['hora'];

                                        // Estado 6 - habilitado - dentro del parqueadero /   Estado 7 - inhabilitado fuera del parqueadero
                                        if ($estado == 6){

                                            $hora1 = new DateTime($h_entrada);//Hora de entrada
                                            $hora2 = new DateTime(date("H:i:s"));//Hora de actual
                                            
                                            //rango de horas dentro del parqueadero
                                            $intervalo = $hora1->diff($hora2);
                                            $tiempoR = $intervalo->format('%H:%i:%s');
                                            
                                            $tabla.= "<td>En el parqueadero</td>
                                                    <td>$tiempoR</td>";

                                            
                                        }else{
                                            
                                            $h_salida = $fila['hora_salida'];
                        
                                            $hora1 = new DateTime($h_entrada);//Hora de entrada
                                            $hora2 = new DateTime($h_salida);//Hora de salida
                        
                                            //rango de horas dentro del parqueadero
                                            $intervalo = $hora2->diff($hora1);
                                            $tiempoR = $intervalo->format('%H:%i:%s');
                                            $tabla.= "<td>$h_salida</td>
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
                                        <h5>N° DE VEHICULOS INGRESADOS</h5><strong>$resul</strong>
                                    </div> ";
                                    } 
                                    
                            else
                                {
                                    $tabla="<div class='sinDatos'><i id='error' class='fas fa-exclamation-triangle'  style='font-size:65px;'></i>
                                            <h3>No se encontraron coincidencias con sus criterios de búsqueda.</h3></div>
                                            ";
                                }
                            echo $tabla;
                    }
                    ?>
                </div>
                <div class="acciones" id="acciones">
                    <div class="btn btn-outline-danger btnImprimir" onclick="imprimir()">
                    <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="btn btn-outline-success btnExcel" onclick="exportTableToExcel('tabla', 'REPORTES_DE_ENTRADAS_Y_SALIDAS<?php echo date('d_m_Y');?>')" >
                        <i class="fas fa-file-excel"></i>
                    </div>
                </div>
                <hr>
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
                    <p>
                       Hola querido usuario, Bienvenido!! <br>
                       Aqui encontraras los manuales que te podran ayudar a saber el funcionamiento de nuestra pagina y el manual es el siguiente: <br>

                       
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
    <script src="../../administrador/parqueo/js/main.js"></script>

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