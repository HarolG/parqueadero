<?php
    include_once("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {

        #Consulta para obtener todos los datos de los vehiculos ingresados el día hoy
        $sql = "SELECT * FROM registro_parqueadero WHERE fecha = CURDATE() AND id_tip_entrada = '1' ORDER BY hora ASC";
        $query = mysqli_query($mysqli, $sql);
        $result = mysqli_fetch_array($query);

        #De aquí cuento cuantos vehiculos han entrado el día de hoy
        $vehiculos_parqueados = $query->num_rows;

        #Consulta para obtener los cupos de los vehiculos 
        $sql2 = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '1'";
        $query2 = mysqli_query($mysqli, $sql2);

        #Defino la variable para los cupos
        $cupos_carros = 0;
        $cupos_motos = 0;
        $cupos_ciclas = 0;
    
        #En este ciclo cuento los cupos que existen en cada zona de parqueo de carros
        while ($row = mysqli_fetch_array($query2)) {
            $cupos_carros = $cupos_carros + $row['cupos_live'];
        }

        #En este ciclo cuento los cupos que existen en cada zona de parqueo de motos
        $sql3 = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '2'";
        $query3 = mysqli_query($mysqli, $sql3);
    
        while ($row2 = mysqli_fetch_array($query3)) {
            $cupos_motos = $cupos_motos + $row2['cupos_live'];
        }

        #En este ciclo cuento los cupos que existen en cada zona de ciclas
        $sql4 = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '3'";
        $query4 = mysqli_query($mysqli, $sql4);
    
        while ($row3 = mysqli_fetch_array($query4)) {
            $cupos_ciclas = $cupos_ciclas + $row3['cupos_live'];
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="css/administrador.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="navegacion">
            <div class="site_title">
                <img src="../../../img/logo_blanco.png" alt="logo" class="logo">
            </div>
            <div class="nav_profile">
                <div class="profile_pic">
                    <img src="../../../img/foto_perfil.png" alt="">
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
                        <a href="administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Reporte de Entradas </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios </i></a>
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
                    <div class="enlaces">
                        <ul>
                            <li><strong><a href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a></strong></li>
                            <li><strong><a href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a></strong></li>
                        </ul>
                    </div>
                    <div class="user">
                        <div class="user_pic">
                            <img src="../../../img/foto_perfil.png" alt="">
                        </div>
                            <ul class="navy">
                                <li>
                                    <a href=""><p><?php echo $_SESSION['nom']," ", $_SESSION['ape']?><i class="fa fa-caret-down" aria-hidden="true"></i></p></a>
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
                        <p><?php print($cupos_ciclas);?></</p>
                    </div>
                </div>
                <div class="dato_container">
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
            <div class="grafica_historia_parqueo">
                <h2>Actividad del Parqueadero</h2>
                <div class="graficas">
                    <div class="grafica_container">
                        <form id="formZonas">
                            <label for="zona">Seleccione la Zona</label>
                            <select name="zona" id="zona">
                                <?php
                                    #Esta consulta trae todas las zonas que existen el parqueadero
                                    $zonasSql = "SELECT id_zona FROM zona_parqueo";
                                    $queryZonas = mysqli_query($mysqli, $zonasSql);

                                    while ($row = mysqli_fetch_array($queryZonas)) {
                                ?>
                                    <option value="<?php print($row["id_zona"]);?>">Zona <?php print($row["id_zona"]);?></option>
                                <?php
                                    }
                                ?>
                                <input type="submit" value="Generar">
                            </select>
                        </form>
                        <div id="graficaHistoria" class="graficaHistoria"></div>
                    </div>
                    <div class="info_zonas">
                        <h2>Información de la zona</h2>
                        <div class ="informacion_zona" id="informacion_zona"></div>
                    </div>
                </div>
            </div>
        </div>
</body>

<!-- Libreria para crear gráficas -->
<script src="../../../library/plotly-latest.min.js"></script>

<!-- Librería que voy a quitar -->
<script src="../../../library/jquery-3.6.0.min.js"></script>

<!-- Javascript general -->
<script src="js/graficas.js"></script>

</html>

<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>