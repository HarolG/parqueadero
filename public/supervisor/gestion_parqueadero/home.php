<?php
    include_once("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {


?>

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
    <link rel="stylesheet" href="css/gestion_parquadero.css">
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
                    <img src="../../../img/foto_perfil.png" alt="UserIcon">
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
                    <a href="../home/home.php">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                <li>
                    <a href="../celadores/index.php">
                        <i class="fas fa-home"></i> Informe Inicio de Sesión
                    </a>
                </li>
                <li>
                    <a href="../gestion/index.php">
                        <i class="fa fa-sign-in-alt"></i> Gestión de Usuarios
                    </a>
                </li>
                <li>
                    <a href="home.php">
                        <i class="fa fa-sign-in-alt"></i> Gestión de Parqueadero
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

                <a class="pull-left links" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de
                    Industria y Construcción</a>

                <a class="pull-left links" style="width: 170px;"
                    href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>

            </ul>
        </nav>
        <!-- Aquí va el contenido -->
        <div class="gestion_container container">
            <div class="row contenedor_general">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Formulario de Registro del Parqueadero</h5>
                            <form id="form_registro">
                                <div class="form-group">
                                    <input type="text" id="form_placa" placeholder="Ingrese la placa del vehiculo"
                                        class="form-control" style="text-transform:uppercase">
                                </div>
                                <div class="form-group">
                                    <select class="form-select btn-block" id="select_tipo_zona">
                                        <option selected>Seleccione el tipo de zona</option>
                                        <?php
                                            $tipozona = "SELECT * FROM tipo_zona";
                                            $query = mysqli_query($mysqli, $tipozona);

                                            while($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value="<?php echo $row['id_tip_zona'];?>">
                                            <?php echo $row['nom_tip_zona'];?></option>
                                        <?php
                                            }

                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select btn-block" aria-label="Default select example"
                                        id="select_zona">
                                        <option selected>Seleccione la zona</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select btn-block" aria-label="Default select example"
                                        id="select_cupo">
                                        <option selected>Seleccione el cupo</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-center boton">salvar
                                    registro</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Seleccione los siguientes valores:</h5>
                            <form action="" class="form" id="form_search_cupo">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <label for="">Seleccione el Tipo de Zona</label>
                                            <select class="form-select btn-block" aria-label="Default select example"
                                                id="search_tipo_zona">
                                                <option selected>Abre el menú</option>
                                                <?php
                                                    $tipozona = "SELECT * FROM tipo_zona";
                                                    $query = mysqli_query($mysqli, $tipozona);
        
                                                    while($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['id_tip_zona'];?>">
                                                    <?php echo $row['nom_tip_zona'];?></option>
                                                <?php
                                                    }
        
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <label for="">Seleccione la Zona</label>
                                            <select class="form-select btn-block" aria-label=".form-select-lg example"
                                                id="search_zona">
                                                <option selected value="">Abre el menú</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="submit" value="Buscar Zona" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card cine_container">
                        <div class="card-body">
                            <h5 class="card-title">Información de los cupos de la zona</h5>
                            <div class="row container cine_container-cupos" id="cine_container-cupos">

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Interpretación de los colores:</h5>
                            <div class="interpretacion_container">
                                <div>
                                    <div class="cupo cupo_Disponible"></div>
                                    <p>Zona Disponible</p>
                                </div>
                                <div>
                                    <div class="cupo cupo_Ocupado"></div>
                                    <p>Zona Ocupada</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
            

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
                    <h4 class="modal-title">Help!!</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt
                        incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione
                        veritatis a unde autem!
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
<!-- Scripts Generales -->

<script src="../../../library/jquery-3.6.0.min.js"></script>
<script src="js/get_zona.js"></script>
<script src="js/info_cupo.js"></script>


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