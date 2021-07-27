<?php
    include('../../../php/conexion.php');

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
    <link rel="stylesheet" href="crearusu.css">
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
                    $result = mysqli_query($mysqli, $sql);
                    while ($row2 = mysqli_fetch_array($result)) {
                        // /almacenamos el nombre de la ruta en la variable $ruta_img/
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
                    <a href="crearusu.php" class="btn-sideBar-SubMenu">
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

        <!-- Ventana Modal Tipo de Vehiculo -->
        <div class="ventana-modal" id="ventana-modal1">

            <form class="formu" action="insertar.php" method="POST">
                <a id="cerrar_modal1" class="cerrar"><i class="fas fa-times-circle"></i></a>
                <h2 class="title" id="title">Nuevo Tipo de Vehiculo</h2>
                <div class="contenedor">
                    <div class="form-group">
                        <label class="dig-user" for="nom_tipo_vehiculo">Digite el Tipo de Vehiculo</label>
                        <input type="text" class="form-control" name="nom_tipo_vehiculo" id="nom_tipo_vehiculo"
                            placeholder="Vehiculo" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="enviar-vehi" class="btn btn-primary btn-block" value="AÑADIR">
                    </div>
                </div>
            </form>

        </div>

        <!-- Ventana Marca-->
        <div class="ventana-modal" id="ventana-modal2">

            <form class="formu" action="insertar.php" method="POST">
                <a id="cerrar_modal2" class="cerrar"><i class="fas fa-times-circle"></i></a>
                <h2 class="title" id="title">Nuevo Marca de Vehiculo</h2>

                <div class="contenedor">
                    <div class="form-group">
                        <label class="dig-user" for="">Digite la nueva Marca del Vehiculo</label>
                        <input type="text" class="form-control" name="nom_marca" placeholder="Marca del Vehiculo"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="enviar-marca" class="btn btn-primary btn-block" value="AÑADIR">
                    </div>
                </div>
            </form>
        </div>

        <!-- Ventana Modal Modelo Vehiculo-->
        <div class="ventana-modal" id="ventana-modal3">

            <form class="formu" action="insertar.php" method="POST">
                <a id="cerrar_modal3" class="cerrar"><i class="fas fa-times-circle"></i></a>
                <h2 class="title" id="title">Nuevo Modelo de Vehiculo</h2>

                <div class="contenedor">
                    <div class="form-group">
                        <label class="dig-user" for="">Digite el nuevo modelo del vehiculo</label>
                        <input type="text" class="form-control" name="nom_modelo" placeholder="Modelo del vehiculo"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="enviar-modelo" class="btn btn-primary btn-block" value="AÑADIR">
                    </div>
                </div>

            </form>
        </div>

        <!-- Ventana Modal Color Vehiculo-->
        <div class="ventana-modal" id="ventana-modal4">

            <form class="formu" action="insertar.php" method="POST">
                <a id="cerrar_modal4" class="cerrar"><i class="fas fa-times-circle"></i></a>
                <h2 class="title" id="title">Nuevo Color de Vehiculo</h2>

                <div class="contenedor">
                    <div class="form-group">
                        <label class="dig-user" for="">Digite el nuevo color del vehiculo</label>
                        <input type="text" class="form-control" name="nom_color" placeholder="Color del vehiculo"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="enviar-color" class="btn btn-primary btn-block" value="AÑADIR">
                    </div>
                </div>

            </form>
        </div>


        <div class="search_vetanaModal-container" id="search_vetanaModal-container">
            <div class="search_vetanaModal-update card crud_container" id="search_vetanaModal-update">
                

            </div>
        </div>


        <!-- Aquí va el contenido -->
        <main class="main row">
            <div class="form_container col-md-5 container">
                <div class="wrapper">
                    <div class="form_title">
                        <p>Formulario para el registro de Vehiculos</p>
                    </div>
                    <form enctype="multipart/form-data" action="insertar.php" class="form_vehiculo" method="POST">
                        <div class="column_container">
                            <div class="column_form">

                                <!-- Número de documento del propietario -->
                                <div class="grupo_formulario grupo_formulario-documento">
                                    <label for="placa">Documento</label>
                                    <input type="text" class="doc" name="doc" id="documento"
                                        placeholder="Numero de Documento" autocomplete="off">
                                </div>
                                <!--    Tipo de Vehiculo-->
                                <div class="grupo_formulario grupo_formulario-tipoVehiculo">
                                    <label class="vehiculo" for="placa" style="cursor: pointer;"><a id="ventana1">Tipo
                                            de Vehiculo<i class="fas fa-plus"></i></a></label>
                                    <select class="vehiculo" name="vehiculo" id="vehiculo" autocomplete="off">

                                        <option value="0">Tipo de Vehiculo</option>
                                        <?php
                                                    $tip = "SELECT * FROM tipo_vehiculo";
                                                    $inser = mysqli_query($mysqli,$tip);
                                                    while($tip = mysqli_fetch_array($inser)){
                                                ?>
                                        <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?>
                                        </option>
                                        <?php
                                                }
                                                ?>
                                    </select>


                                </div>

                                <!--    Modelo-->
                                <div class="grupo_formulario grupo_formulario-modelo">

                                    <label class="placa" for="placa" style="cursor: pointer;"><a id="ventana3">Modelo<i
                                                class="fas fa-plus"></i></a></label>

                                    <select class="placa" name="modelo" id="modelo" autocomplete="off">
                                        <option value="0">Modelo del Vehiculo</option>
                                        <?php
                                                        $tipo = "SELECT * FROM modelo";
                                                        $inser = mysqli_query($mysqli,$tipo);
                                                        while($tip = mysqli_fetch_array($inser)){
                                                    ?>
                                        <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?>
                                        </option>
                                        <?php
                                                    }
                                                    ?>
                                    </select>
                                </div>


                            </div>
                            <div class="column_form">



                                <!-- Número de placa del vehiculo -->
                                <div class="grupo_formulario grupo_formulario-noPlaca">
                                    <label for="placa">Placa</label>
                                    <input type="text" onkeyup="this.value=this.value.toUpperCase()" class="placa"
                                        name="placa" id="placa" placeholder="Ingrese Numero de la placa"
                                        autocomplete="off">
                                </div>


                                <!--   Tipo de Marca-->
                                <div class="grupo_formulario grupo_formulario-marca">
                                    <label class="marca" for="placa" style="cursor: pointer;"><a id="ventana2">Marca<i
                                                class="fas fa-plus"></i></a></label>
                                    <select class="marca" name="marca" id="marca" autocomplete="off">
                                        <option value="0">Tipo de Marca</option>
                                        <?php
                                                        $tipo = "SELECT * FROM marca";
                                                        $inser = mysqli_query($mysqli,$tipo);
                                                        while($tip = mysqli_fetch_array($inser)){
                                                    ?>
                                        <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?>
                                        </option>
                                        <?php
                                                    }
                                                    ?>
                                    </select>
                                </div>

                                <!--    Tipo de color-->
                                <div class="grupo_formulario grupo_formulario-color">
                                    <label class="color" for="placa" style="cursor: pointer;"><a id="ventana4">Color del
                                            vehiculo<i class="fas fa-plus"></i></a></label>
                                    <select class="color" name="color" id="color" autocomplete="off">

                                        <option value="0">Color de Vehiculo</option>
                                        <?php
                                                        $selec = "SELECT * FROM color";
                                                        $inser = mysqli_query($mysqli,$selec);
                                                        while($tip = mysqli_fetch_array($inser)){
                                                    ?>
                                        <option name="tipo" value="<?php echo $tip[0]; ?>"><?php echo $tip[1]; ?>
                                        </option>
                                        <?php
                                                    }
                                                    ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="anotaciones_container">
                            <label for="anotaciones">Anotaciones</label>
                            <textarea class="anota" name="anotaciones" id="anotaciones"></textarea>
                        </div>
                        <div class="cargue_container">
                            <div class="subtitle_form">
                                <p>Cargue los siguiente Documentos</p>
                            </div>
                            <div class="cargue_main">
                                <div class="grupo_cargue">
                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                    <input type="hidden" name="tarjeta" id="tarjet" value="30000" />
                                    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                    Subir Tarjeta de Propiedad: <input name="tarjeta" id="tarjeta" type="file" required
                                        onchange="return fileValidation2()" />
                                </div>

                                <div class="grupo_cargue" id="imagePreview">
                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                    <input type="hidden" id="vehic" name="vehic" value="30000" />
                                    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                    Imagen del Vehiculo: <input id="imagen" name="vehic" type="file" required
                                        onchange="return fileValidation()" />
                                </div>
                            </div>
                        </div>
                        <div class="boton_container">
                            <input type="submit" value="CREAR" onclick="return enviarFormulario();" name="registro"
                                value='Enviar'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card crud_container">
                    <div class="card-header text-center">
                        Barra de busqueda para Vehiculos
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Consulte la información de los vehiculos</h5>
                        <div class="notificacion_busqueda text-center container" id="search_notificacion">
                            <!-- Error, el vehiculo no fue encontrado -->
                        </div>
                        <form class="container" id="form_search_vehiculo">
                            <div class="form-group">
                                <label for="">Digite la placa</label>
                                <input type="text" name="search_placa" id="search_placa" class="form-control"
                                    aria-describedby="helpId">
                                <p id="helpId" class="text-muted">Escriba la placa del vehiculo registrada en la
                                    aplicación</p>
                                <input type="submit" class="btn btn-primary" value="Buscar">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card crud_container" id="crud_container"></div>
            </div>
        </main>

        <div class="container_modal" id="container_modal">
            <div class="container_propietario">
                <div class="btn_cerrar">
                    <i class="fa fa-times-circle-o" aria-hidden="true" id="cerrarModal"></i>
                </div>
                <div class="container_gruposModales" id="container_gruposModales">

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
                        los manuales son los siguientes: <br>

                        <a href="https://drive.google.com/file/d/1H_dSFSHAyf4bWmgumzvoaixI6uW7P6A3/view?usp=sharing">Manual
                            de Usuarios</a> <br>
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
<!-- Scripts cambiables -->
<script src="../../../library/jquery-3.6.0.min.js"></script>
<script src="js/info_vehiculo.js"></script>
<script src="js/crear.js"></script>

<!--====== Scripts pagina ¡¡NO CAMBIAR!! -->
<script src="../../../layout/js/jquery-3.1.1.min.js"></script>
<script src="../../../layout/js/sweetalert2.min.js"></script>
<script src="../../../layout/js/bootstrap.min.js"></script>
<script src="../../../layout/js/material.min.js"></script>
<script src="../../../layout/js/ripples.min.js"></script>
<script src="js/validacion.js"></script>
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