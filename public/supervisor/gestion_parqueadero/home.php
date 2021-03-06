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
    <?php
        if(isset($_POST['inputDetaCupos'])) {
            $id_deta_cupos = $_POST['inputDetaCupos'];

            $sql = "SELECT detalle_cupos.id_deta_cupos, zona_parqueo.id_zona, detalle_cupos.id_deta_vehiculo, detalle_cupos.nombre_cupo, estado.nom_estado, tipo_zona.nom_tip_zona, detalle_vehiculo.documento, detalle_vehiculo.placa FROM detalle_cupos LEFT JOIN zona_parqueo ON detalle_cupos.id_zona = zona_parqueo.id_zona LEFT JOIN estado ON estado.id_estado = detalle_cupos.id_estado LEFT JOIN tipo_zona ON tipo_zona.id_tip_zona = zona_parqueo.id_tip_zona LEFT JOIN detalle_vehiculo ON detalle_vehiculo.id_deta_vehiculo = detalle_cupos.id_deta_vehiculo WHERE detalle_cupos.id_deta_cupos = '$id_deta_cupos'";
            $query = mysqli_query($mysqli, $sql);
            $resultado = mysqli_fetch_assoc($query);

            $id_zona = $resultado['id_zona'];
            $documento = $resultado['documento'];
            $placa = $resultado['placa'];
            $nombre_cupo = $resultado['nombre_cupo'];
            $nom_estado_cupo = $resultado['nom_estado'];
            $nom_tip_zona = $resultado['nom_tip_zona'];

    ?>
    <div class="prueba3">
        <div class="prueba4">
            <form method="POST" class="card wrapper" id="formSalida">
                <h4>Formulario de Salida</h4>
                <div class="form-group">
                    <label for="salida_idZona">Vehiculo parqueado en la zona:</label>
                    <input type="text" id="salida_idZona" class="form-control" value="Zona <?php echo $id_zona?>"
                        disabled>
                    <input type="hidden" id="salida_deta_cupos" value="<?php echo $id_deta_cupos; ?>">
                </div>
                <div class="form-group">
                    <label for="salida_nomTipZona">Tipo de zona:</label>
                    <input type="text" id="salida_nomTipZona" class="form-control" value="<?php echo $nom_tip_zona?>"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="salida_placa">Placa del vehiculo:</label>
                    <input type="text" id="salida_placa" class="form-control" value="<?php echo $placa?>" disabled>
                </div>
                <div class="form-group">
                    <label for="salida_placa">Documento del propietario:</label>
                    <input type="text" id="salida_documento" class="form-control" value="<?php echo $documento?>"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="salida_cupo">El vehiculo est?? parqueado en el cupo:</label>
                    <input type="text" id="salida_cupo" class="form-control" value="Cupo <?php echo $nombre_cupo?>"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="salida_nomEstadoCupo">Estado del cupo:</label>
                    <input type="text" id="salida_nomEstadoCupo" class="form-control"
                        value="<?php echo $nom_estado_cupo?>" disabled>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Salvar Salida</button>
                    <a href="home.php" type="submit" class="btn btn-block btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <?php
        }
    ?>

    <div class="codigo_container-general" id="codigo_container-general">
        <div class="codigo_container-qr">
            <h3>Escanee el c??digo de Barras</h3>
            <div class="row container_qr">
                <div id="reader" class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group select_codigo" id="select_codigo_1">
                        <label for="select_codigo_entrada">Seleccione el tipo de entrada</label>
                        <select class="form-select btn-block" name="" id="select_codigo_entrada">
                            <option value="0" selected>Seleccione la entrada</option>
                            <option value="1">Entrada</option>
                            <option value="2">Salida</option>
                        </select>
                    </div>
                    <div class="form-group select_codigo" id="select_codigo_2">
                        <label for="select_codigo_vehiculo">Seleccione el vehiculo</label>
                        <select class="form-select btn-block" name="" id="select_codigo_vehiculo">
                            <option value="0" selected>Seleccione el vehiculo</option>
                        </select>
                    </div>
                    <div class="form-group select_codigo" id="select_codigo_3">                
                    </div>
                </div>
            </div>
            <div class="group-form boton_qr">
                <div id="boton_codigo-cancelar" class="btn btn-danger btn-block">Cancelar</div>
            </div>
        </div>
    </div>

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
                        <i class="far fa-envelope"></i> Buz??n de mensajeria
                    </a>
                </li>
                <li>
                    <a href="../gestion/index.php">
                        <i class="fas fa-users-cog"></i> Gesti??n de Usuarios
                    </a>
                </li>
                <li>
                    <a href="../gestion_parqueadero/home.php">
                        <i class="fa fa-sign-in-alt"></i> Gesti??n del Parqueadero
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
                    Industria y Construcci??n</a>

                <a class="pull-left links" style="width: 170px;"
                    href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>

            </ul>
        </nav>
        <!-- Aqu?? va el contenido -->
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
                                    <select class="form-select btn-block" aria-label="Default select example"
                                        id="select_documento">
                                        <option selected>Seleccione el documento</option>
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
                                <button type="submit" class="btn btn-primary btn-block text-center boton">Salvar
                                    registro</button>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <h5 class="card-title">Escanee la entrada o salida del parqueadero</h5>
                            <div class="container-qr">
                                <i class="fa fa-qrcode" aria-hidden="true"></i>
                                <button type="submit" id="boton_codigo" class="btn btn-primary btn-block text-center boton">Escanear
                                    C??digo</button>
                            </div>
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
                                                <option selected>Abre el men??</option>
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
                                                <option selected value="">Abre el men??</option>
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
                            <h5 class="card-title">Informaci??n de los cupos de la zona</h5>
                            <div class="row container cine_container-cupos" id="cine_container-cupos">

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Interpretaci??n de los colores:</h5>
                            <div class="interpretacion_container">
                                <div>
                                    <div class="cupo cupo_Libre"></div>
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
                        Aqui encontraras los manuales que te podran ayudar a saber el funcionamiento de nuestra pagina y
                        el manual es el siguiente: <br>


                        <a href="https://drive.google.com/file/d/1dfh-e8XFyhJfa4qRkmCpH0x2e9evBs34/view?usp=sharing">Manual
                            tecnico</a>
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
<script src="js/html5-qrcode.min.js"></script>

<script src="js/get_zona.js"></script>
<script src="js/info_cupo.js"></script>
<script src="js/escaner.js"></script>


<!--====== Scripts pagina ????NO CAMBIAR!! -->
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