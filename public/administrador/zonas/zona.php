<?php
    include("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Zonas</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
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
                        <p class="profile_name">John Doe</p>
                    </div>
                </div>
            </div>
            <div class="menu_section">
                <h5>GENERAL</h5>
                <ul>
                    <li>
                        <a href="../home/administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
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
                    <div class="user">
                        <div class="user_pic">
                            <img src="../../../img/foto_perfil.png" alt="">
                        </div>
                            <ul class="navy">
                                <li>
                                    <a href=""><p>John Doe <i class="fa fa-caret-down" aria-hidden="true"></i></p></a>
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
        <form action="php/crear_zona.php" id="form" method="POST">
            <h2 class="titulo">CREAR ZONAS</h2>
            <!-- <input type="text" name="idzona" id="inputzona" placeholder="Ingrese el id de la zona" autocomplete="off" required> -->
            <select name="tipozona" id="tipozona">
                <option value="">Seleccione un tipo de zona</option>
                <?php
                            $sql = "SELECT * FROM tipo_zona";
                            $query = mysqli_query($mysqli, $sql);
                
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                <option value="<?php echo $row['id_tip_zona'];?>"><?php echo $row['nom_tip_zona'];?></option>
                <?php
                            }
                        ?>
            </select>
            <input type="text" name="cupos_zona" id="inputcupos" placeholder="Ingrese la cantidad de cupos"
                autocomplete="off" required>
            <select name="cupozona" id="cupozona">
                <option value="">Seleccione un estado</option>
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
            <input type="submit" name="guardar" id="guardar" value="Crear Zona">
        </form>

        <table class="zonas_registradas">
            <thead>
                <tr>
                    <td class="head_table">ID zona</td>
                    <td class="head_table">Tipo de Zona</td>
                    <td class="head_table">Cantidad de cupos</td>
                    <td class="head_table">Estado</td>
                </tr>
            </thead>
            <tbody>
                <?php
                            $query = "SELECT * FROM zona_parqueo, tipo_zona, estado 
                            WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona AND zona_parqueo.id_estado = estado.id_estado";
                            $result_tasks = mysqli_query($mysqli, $query);    
                    
                            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                <tr>
                    <td class="body_table"><?php echo $row['id_zona'] ?></td>
                    <td class="body_table"><?php echo $row['nom_tip_zona'] ?></td>
                    <td class="body_table"><?php echo $row['cupos'] ?></td>
                    <td class="body_table"><?php echo $row['nom_estado']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
        </div>
    </div>

    <script src="../../../library/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>