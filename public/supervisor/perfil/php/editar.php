<?php
include("../../../../php/conexion.php");
// $cantidad = '';
$nombre = '';
$apellido = '';
$ed = '';
$cel = '';
$dir = '';
$cor = '';
if (isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass'])) {

    if (isset($_GET['documento'])) {
        $id = $_GET['documento'];
        $query = "SELECT * FROM usuario WHERE documento=$id";
        $result = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $ed = $row['edad'];
            $cel = $row['celular'];
            $dir = $row['direccion'];
            $cor = $row['correo'];
        }
    }

    if (isset($_POST['update'])) {
        $id = $_GET['documento'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $ed = $_POST['edad'];
        $cel = $_POST['celular'];
        $dir = $_POST['direccion'];
        $cor = $_POST['correo'];
        $foto = $_FILES["foto"]["name"];
        $ruta = $_FILES["foto"]["tmp_name"];
        $destino = "../fotos/" . $foto;
        copy($ruta, $destino);

        $query = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', edad = '$ed', celular = '$cel', direccion = '$dir', correo = '$cor', foto = '$foto' WHERE documento = $id";
        mysqli_query($mysqli, $query);

        if ($query) {
            echo '<script type="text/javascript">
                    alert("se actualizaron los datos correctamente");
                    window.location.href="../perfil.php";
                </script>';
        }
    }

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>Inicio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="icon" href="../../../../img/logo.ico" />
        <!-- estilos generales -->
        <link rel="stylesheet" href="../../../../layout/css/main.css">
        <link rel="stylesheet" href="../css/perfil.css">
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
                    <img src="../../../../img/Logo_parking_2.0.png" alt="logo" class="logo" style="width: 150px; height: 70px; display: flex; justify-content: center; margin-left:40px;">
                </div>
                <!-- SideBar User info -->
                <div class="full-box dashboard-sideBar-UserInfo">
                    <figure class="full-box">
                        <?php

                        $sql = "SELECT * FROM usuario WHERE id_tip_usu = 3";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row2 = mysqli_fetch_array($result)) {
                            /*almacenamos el nombre de la ruta en la variable $ruta_img*/
                            $ruta_img = $row2["foto"];
                            $nombr = $row2['nombre'];
                            $apelli = $row2['apellido'];
                        }
                        ?>
                        <img src="../fotos/<?php echo $ruta_img; ?>" class="imagen" alt="">
                        <!-- <img src="../../../../img/foto_perfil.png" alt="UserIcon"> -->
                        <div class="text-center text-titles">
                            <p class="profile_welcome">Bienvenido,</p>
                            <p class="profile_name">
                                <?php echo $_SESSION['nom'], " ", $_SESSION['ape'] ?>
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
                        <a href="../../home/administrador.php">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="../../parqueo/parqueo.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Reporte de entradas
                        </a>

                    </li>
                    <li>
                        <a href="../../zonas/zona.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear zonas
                        </a>

                    </li>
                    <li>
                        <a href="../../usuarios/usuarios.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-users" aria-hidden="true"></i> Crear usuarios
                        </a>

                    </li>
                    <li>
                        <a href="../../crear/crearusu.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-car" aria-hidden="true"></i> Registro de vehiculos
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

                    <a class="pull-left links" style="width: 170px;" href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>

                </ul>
            </nav>
            <!-- Aquí va el contenido -->
            <div class="contenido">

                <form action="editar.php?documento=<?php echo $_GET['documento']; ?>" method="POST" id="formu" enctype="multipart/form-data" onsubmit="return validarformulario();">
                    <h2 class="titulo">ACTUALIZAR INFORMACION DE USUARIO</h2>
                    <div class="foto_perfil">
                        <?php
                        $sql = "SELECT * FROM usuario WHERE documento = $id";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row2 = mysqli_fetch_array($result)) {
                            /*almacenamos el nombre de la ruta en la variable $ruta_img*/
                            $ruta_img = $row2["foto"];
                        }
                        ?>
                        <label for="foto">
                            <img src="../fotos/<?php echo $ruta_img; ?>" class="imagen" alt="">

                        </label>
                        <div class="input_file col-md-6 col-sm-6 col-xs-6">
                            <input type="file" name="foto" id="foto" class="fotito">
                        </div>
                    </div>
                    <br>
                    <!-- <input type="text" name="idzona" id="inputzona" placeholder="Ingrese el id de la zona" autocomplete="off" required> -->
                    <!-- <label for="cant_cupos" class="label" style="background:none; color:black; font-size:15px; margin-left:-5px;">Cantidad de cupos</label>
                <input type="text" name="cant_cupos" id="cant_cupos" placeholder="Cupos:cupos"> -->
                    <div>

                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="nombre" id="nombre" placeholder="<?php echo $row['nombre'] ?>">
                    </div>
                    <div>
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" class="apellido" id="apellido" placeholder="<?php echo $row['apellido'] ?>">

                    </div>
                    <div>
                        <label for="edad">Edad</label>
                        <input type="number" name="edad" class="edad" id="edad" placeholder="<?php echo $row['edad'] ?>">

                    </div>
                    <div>
                        <label for="celular">Celular</label>
                        <input type="number" name="celular" class="celular" id="celular" placeholder="<?php echo $row['celular'] ?>">

                    </div>
                    <div>
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" class="direccion" id="direccion" placeholder="<?php echo $row['direccion'] ?>">

                    </div>
                    <div>
                        <label for="correo">Correo Electronico</label>
                        <input type="email" name="correo" class="correo" id="correo" placeholder="<?php echo $row['correo'] ?>">

                    </div>
                    <button class="btn-actualizar" name="update">
                        ACTUALIZAR
                    </button>
                    <a href="../perfil.php" class="btn-actualiza" style="text-decoration: none;">
                        REGRESAR
                    </a>
                </form>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Help!!</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">Ok <i class="fas fa-exclamation"></i> </button>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <!-- Scripts cambiables -->
    <script src="../../../library/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/validarform.js"></script>


    <!--====== Scripts pagina ¡¡NO CAMBIAR!! -->
    <script src="../../../../layout/js/jquery-3.1.1.min.js"></script>
    <script src="../../../../layout/js/sweetalert2.min.js"></script>
    <script src="../../../../layout/js/bootstrap.min.js"></script>
    <script src="../../../../layout/js/material.min.js"></script>
    <script src="../../../../layout/js/ripples.min.js"></script>
    <script src="../../../../layout/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../../../layout/js/main.js"></script>
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