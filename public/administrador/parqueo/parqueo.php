<?php
    include("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
        $tipoZona = $mysqli -> query ("SELECT * FROM tipo_zona");
        $zonas = $mysqli -> query ("SELECT id_zona,cupos,id_estado,nom_tip_zona,cupos_live FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
        /* $parqueo = $mysqli -> query("SELECT SELECT id_registro, nom_tip_entrada, placa, nom_tip_zona, documento,nombre,apellido,celular
        FROM registro_parqueadero,zona_parqueo,tipo_zona, tipo_entrada, usuario") */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de entrada</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
                        <a href="../home/administrador.php"><i class="fa fa-home " aria-hidden="true"> Inicio </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Registro de
                                Entrada y Salida </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../usuarios/usuarios.php"><i class="fa fa-users" aria-hidden="true"> Crear Usuarios
                            </i></a>
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
                                <a href="">
                                    <p>John Doe <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                                </a>
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
            <div class="ingreso">
                <form action="php/entrada.php" method="POST" class="formRegistro">
                    <div class="filtro"><br>
                        <label for="">Zona de Parqueo:</label>

                        <select class="tipoZona" id="tipoZona" name="tipoZona">
                            <option value="0" placeholder=""></option>
                            <?php
                                    while ($resul = mysqli_fetch_array($tipoZona)) 
                                    { echo "<option value=$resul[id_tip_zona]>$resul[nom_tip_zona]</option>";}
                                
                                ?>
                        </select>
                    </div>
                    <div class="cantidadCupos">
                        <?php
                            while ($resul2 = mysqli_fetch_array($zonas)) {

                                echo "
                                <div class='darosZonas'>
                                    <h2>ZONA $resul2[id_zona]</h2>
                                    <h3>$resul2[nom_tip_zona]</h3>
                                    <label>Cupos Disponibles: $resul2[cupos_live]</label>
                                </div>
                                    
                                ";
                            }
                        ?>


                    </div>
                    <div class="lugar" id="lugar"></div>
                    <div class="registro" id="registro">
                        <h2>REGISTRO DE ENTRADA</h2>
                        <label for="">Número de Placa:</label>
                        <input type="text" name="placa"><br>

                        <label for="">Fecha: <?php echo date("d-m-Y"); ?> </label><br>

                        Hora: <label for="" id="reloj" class="reloj"> 00 : 00 : 00</label><br>
                        <input type="submit" name="registrar" value="REGISTRAR">
                    </div>
                </form>
            </div>
        </div>




        <script src="js/main.js"></script>
        <script language="javascript">
            $(document).ready(function () {
                $("#tipoZona").change(function () {

                    $("#tipoZona option:selected").each(function () {
                        id_cupo = $(this).val();
                        $.post("php/lugares.php", {
                            id_cupo: id_cupo
                        }, function (data) {
                            $("#lugar").html(data);
                        });
                    });
                })
            });
        </script>
</body>

</html>

<?php
    } else {
        echo '<script type="text/javascript">
                    window.location.href="../../login/login.html";
                </script>';
    }
?>