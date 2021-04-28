<?php
    include_once("../../../php/conexion.php");

    $sql = "SELECT * FROM registro_parqueadero WHERE fecha = CURDATE() AND id_tip_entrada = '1' ORDER BY hora ASC";
    $query = mysqli_query($mysqli, $sql);
    $result = mysqli_fetch_array($query);

    $vehiculos_parqueados = $query->num_rows;

    $sql2 = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '1'";
    $query2 = mysqli_query($mysqli, $sql2);

    $cupos_carros = 0;
    $cupos_motos = 0;
    
    while ($row = mysqli_fetch_array($query2)) {
        $cupos_carros = $cupos_carros + $row['cupos'];
    }

    $sql3 = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '2'";
    $query3 = mysqli_query($mysqli, $sql3);
    
    while ($row2 = mysqli_fetch_array($query3)) {
        $cupos_motos = $cupos_motos + $row2['cupos'];
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
                        <a href="administrador.html"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-archive" aria-hidden="true"> Formularios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-archway" aria-hidden="true"> UI Elements </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h5>SUBGENERAL (?</h5>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-archive" aria-hidden="true"> Formularios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-archway" aria-hidden="true"> UI Elements </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="contenido">
            <div class="nav_menu">
                <div class="container_nav-menu">
                    <div class="icon_menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <div class="user">
                        <div class="user_pic">
                            <img src="../../../img/foto_perfil.png" alt="">
                        </div>
                        <p>John Doe <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                    </div>
                </div>
            </div>
            <!-- Aquí va el contenido -->
            <div class="datos_parqueo-container">
                <div class="dato_container">
                    <small> <i class="fas fa-car"></i> Entrada al Parqueadero Hoy</small>
                    <div class="container_conteo">
                        <p><?php print($vehiculos_parqueados); ?></p>
                    </div>
                </div>
                <div class="dato_container">
                    <small><i class="fa fa-clock-o" aria-hidden="true"></i> Tiempo Promedio de Parqueo</small>
                    <div class="container_conteo">
                        <p>2 Horas</p>
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
                <div id="graficaHistoria"></div>
            </div>
        </div>
</body>

<script src="../../../library/plotly-latest.min.js"></script>
<script src="../../../library/jquery-3.6.0.min.js"></script>
<script src="js/graficas.js"></script>

</html>