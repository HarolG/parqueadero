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
        <link rel="stylesheet" href="css/style.css">
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
                        <a href="reportes.php">
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
            <div class="reportes">
                <h2>REPORTES E INFORMES</h2>
                <p>Seleccione el tipo de reporte que desea ver</p>

                <a href="../reportes_entradas/reportes.php">
                    <div class="cuadro">
                        <div class="ico">
                            <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                        </div>
                        
                        <div class="info">
                            <h3>REPORTE DE ENTRADAS Y SALIDAS PARQUEADERO</h3>
                            <p>Permite consultar los registros almacenados de entradas y salidas de vehículos, según la zona de parqueo que desee seleccionar.</p>
                        </div>
                    </div>
                </a>

                <a href="../reporte_vehiculo/reporte.php">
                    <div class="cuadro">
                        <div class="ico">
                            <i class="fa fa-car" aria-hidden="true"></i>
                        </div>
                        
                        <div class="info">
                            <h3>REPORTE DE REGISTRO DE VEHICULOS</h3>
                            <p>Permite visualizar todos los registro almacenados de los vehículos permitidos para el ingreso al parqueadero.</p>
                        </div>
                    </div>
                </a>

                <a href="../celadores/index.php">
                    <div class="cuadro">
                        <div class="ico">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        
                        <div class="info">
                            <h3>INFORME DE INICIO DE SESION DE USUARIO </h3>
                            <p>Permite conocer los horarios en los cuales los celadores laboran.</p>
                        </div>
                    </div>
                </a>
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