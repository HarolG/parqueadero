<?php
include("../../../../php/conexion.php");

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

        if ($nombre) {
            $query = "UPDATE usuario SET nombre = '$nombre' WHERE documento = $id";
            $resultado = mysqli_query($mysqli,$query);
            if ($resultado) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else if ($apellido) {
            $query2 = "UPDATE usuario SET apellido = '$apellido' WHERE documento = $id";
            $resultado1 = mysqli_query($mysqli,$query2);
            if ($resultado1) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else if ($ed) {
            $query3 = "UPDATE usuario SET edad = '$ed' WHERE documento = $id";
            $resultado2 = mysqli_query($mysqli,$query3);
            if ($resultado2) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else if ($cel) {
            $query4 = "UPDATE usuario SET celular = '$cel' WHERE documento = $id";
            $resultado3 = mysqli_query($mysqli,$query4);
            if ($resultado3) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else if ($dir) {
            $query5 = "UPDATE usuario SET direccion = '$dir' WHERE documento = $id";
            $resultado4 = mysqli_query($mysqli,$query5);
            if ($resultado4) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else if ($cor) {
            $query6 = "UPDATE usuario SET correo = '$cor' WHERE documento = $id";
            $resultado5 = mysqli_query($mysqli,$query6);
            if ($resultado5) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
        } else {

            $query = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', edad = '$ed', celular = '$cel', direccion = '$dir', correo = '$cor' WHERE documento = $id";
            $resultado7 = mysqli_query($mysqli, $query);
    
            if ($resultado7) {
                echo '<script type="text/javascript">
                        alert("se actualizaron los datos correctamente");
                        window.location.href="../perfil.php";
                      </script>';
            }
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

                        $sql = "SELECT * FROM usuario WHERE id_tip_usu = 2";
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
                            <a href="../perfil.php">
                                <i class="fas fa-cogs"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-exit-system2">
                                <i class="fas fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- SideBar Menu -->
                <ul class="list-unstyled full-box dashboard-sideBar-Menu">
                    <li>
                        <a href="../../home/home.php">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="../../gestion_parqueadero/home.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-car" aria-hidden="true"></i> Gestion del Parqueadero
                        </a>
                    </li>
                    <li>
                        <a href="../../reportes_entradas/reportes.php" class="btn-sideBar-SubMenu">
                            <i class="fa fa-sign-in-alt" aria-hidden="true"></i> Reporte de Entradas
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

                    <a class="pull-left links" style="width: 250px;" href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a>

                    <a class="pull-left links" style="width: 170px;" href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a>

                </ul>
            </nav>
            <!-- Aquí va el contenido -->
            <div class="contenido">

                <form action="editar.php?documento=<?php echo $_GET['documento']; ?>" method="POST" id="formu" enctype="multipart/form-data">
                    <h2 class="titulo">ACTUALIZAR INFORMACION DE USUARIO</h2>
                    <div class="foto_perfil">
                        <?php
                        $sql = "SELECT * FROM usuario WHERE documento = $id";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row2 = mysqli_fetch_array($result)) {
                            $ruta_img = $row2["foto"];
                        }
                        ?>
                        <label for="foto">
                            <img src="../fotos/<?php echo $ruta_img; ?>" class="imagen" alt="">

                        </label>
                        <div class="input_f">
                            <a href="cambiarfoto.php">CAMBIAR AVATAR</a>
                        </div>
                    </div>
                    <br>
                    <div>

                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="nombre" onkeyup="this.value=this.value.toUpperCase()" id="nombre" placeholder="<?php echo $row['nombre'] ?>">
                    </div>
                    <div>
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" class="apellido" onkeyup="this.value=this.value.toUpperCase()" id="apellido" placeholder="<?php echo $row['apellido'] ?>">

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
                        <input type="text" name="direccion" class="direccion" onkeyup="this.value=this.value.toUpperCase()" id="direccion" placeholder="<?php echo $row['direccion'] ?>">

                    </div>
                    <div>
                        <label for="correo">Correo Electronico</label>
                        <input type="email" name="correo" class="correo" onkeyup="this.value=this.value.toUpperCase()" id="correo" placeholder="<?php echo $row['correo'] ?>">

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