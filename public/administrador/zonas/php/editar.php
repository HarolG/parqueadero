<?php
 include("../../../../php/conexion.php");
// $cantidad = '';
$estado= '';

if  (isset($_GET['id_zona'])) {
  $id = $_GET['id_zona'];
  $query = "SELECT * FROM zona_parqueo, estado WHERE zona_parqueo.id_estado = estado.id_estado AND id_zona=$id";
  $result = mysqli_query($mysqli, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    // $cantidad = $row['title'];
    $estado = $row['nom_estado'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id_zona'];
//   $title= $_POST['title'];
  $estado = $_POST['cambiar_estado'];

  $query = "UPDATE zona_parqueo set id_estado = '$estado' WHERE id_zona=$id";
  mysqli_query($mysqli, $query);

  if ($query) {
      echo '<script type="text/javascript">
                alert("se actualizo el estado correctamente");
                window.location.href="../zona.php";
            </script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../img/logo.ico"/>
    <title>Crear Zonas</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="../css/form_insert.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="navegacion">
            <div class="site_title">
                <img src="../../../../img/Logo_parking_2.0.png" alt="logo" class="logo">
            </div>
            <div class="nav_profile">
                <div class="profile_pic">
                    <img src="../../../../img/foto_perfil.png" alt="">
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
                        <a href="../../home/administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Reporte de Entradas </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../../crear/crearusu.php"> <i class="fa fa-car" aria-hidden="true"> Registrar Vehiculos </i></i></a>
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
                            <img src="../../../../img/foto_perfil.png" alt="">
                        </div>
                            <ul class="navy">
                                <li>
                                    <a href=""><p><?php echo $_SESSION['nom']," ", $_SESSION['ape']?><i class="fa fa-caret-down" aria-hidden="true"></i></p></a>
                                    <ul>
                                        <li><a href="">Your Profile</a></li>
                                        <li><a href="">Settings</a></li>
                                        <li><a href="../../../../php/cerrarsesion.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                    </div>
                </div>
           </div>
           <!-- Aquí va el contenido -->
           <form action="editar.php?id_zona=<?php echo $_GET['id_zona']; ?>" method="POST" id="formu">
            <h2 class="titulo">EDITAR ESTADO</h2>
            <!-- <input type="text" name="idzona" id="inputzona" placeholder="Ingrese el id de la zona" autocomplete="off" required> -->
            <select name="cambiar_estado" id="cambiar">
                <option value=""><?php echo $row['nom_estado'];?></option>
                <?php
                            $sql = "SELECT * FROM estado";
                            $query = mysqli_query($mysqli, $sql);
                
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                <option value="<?php echo $row['id_estado'];?>"><?php echo $row['nom_estado'];?></option>
                <?php
                            }
                        ?>
            </select>
            <!-- <input type="submit" name="guardar" id="guardar" value="Crear Estado"> -->
            <button class="btn-actualizar" name="update">
                Actualizar Estado
            </button>
        </form>
        <div class="btn-volver">
            <a href="../zona.php">REGRESAR</a>
        </div>
    </div>
    </div>
        </div>
    </div>

    <script src="../../../library/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

