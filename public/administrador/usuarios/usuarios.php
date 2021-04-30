<?php
    include("../../../php/conexion.php");
?>
<!-- 
Importante,
Esto es solo una plantilla
En caso de que las imagenes no se inserten, o los estilos no se inserten
Favor revisar los direccionamientos 
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <!-- Estilos Generales -->
    <link rel="stylesheet" href="../../../layout/css/navegacion.css">
    <link rel="stylesheet" href="css/usuarios.css">
    <!-- Data tables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <!-- Tipo de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400&display=swap"rel="stylesheet">
    <!-- funcion para hacer una pregunta -->
    <script type="text/javascript">
		function confirmar(){
			return confirm('¿Estas Seguro? se eliminaran los datos y no podras restaurarlos');

		}

	</script>
    
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
                        <a href="../parqueo/parqueo.php"> <i class="fa fa-sign-in-alt" aria-hidden="true"> Registro de Entrada y Salida </i></i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../zonas/zona.php"><i class="fa fa-plus" aria-hidden="true"> Crear Zonas </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="../usuarios/usuarios.html"><i class="fa fa-users" aria-hidden="true"> Usuarios </i></a>
                        <div class="nav_decorate"></div>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-car" aria-hidden="true"> Registrar Vehiculos </i></i></a>
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
        <!-- Aquí va el contenido -->
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
            <!-- Aquí va la vista de los usuarios -->
            <div class="elduro">
                <h1 style="text-align: center; padding: 25px;">USUARIOS</h1>

                <a href="registrar.php" class="btn"><i class="fas fa-user-plus"> CREAR USUARIO</i></a>
                <!-- codigo para mostrar los usuarios existentes -->
                <div class="tabla"> 
                    <table class="table">
                    <?php
                        $consul="SELECT usuario.documento,usuario.nombre,usuario.apellido,usuario.edad,usuario.celular,usuario.direccion,usuario.correo,tipo_usuario.nom_tip_usu,tipo_documento.nom_tip_doc FROM usuario 
                        INNER JOIN tipo_usuario on usuario.id_tip_usu = tipo_usuario.id_tip_usu 
                        INNER JOIN tipo_documento on usuario.id_tip_doc = tipo_documento.id_tip_doc";
                        $resultado=mysqli_query($mysqli,$consul);
                    ?>
                        <thead>
                            <tr>
                                <td>IDENTIFICACION</td>
                                <td>NOMBRE</td>
                                <td>APELLIDO</td>
                                <td>EDAD</td>
                                <td>CELULAR</td>
                                <td>DIRECCION</td>
                                <td>CORREO</td>
                                <td>USUARIO</td>
                                <td>DOCUMENTO</td>
                                <td>ACCIONES</td>
                            </tr>
                        </thead>
                        <?php
                                    while($mostrar1=mysqli_fetch_assoc($resultado)){
                                ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $mostrar1['documento']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['nombre']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['apellido']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['edad'];?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['celular']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['direccion']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['correo']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['nom_tip_usu']; ?>
                                </td>
                                <td>
                                    <?php echo $mostrar1['nom_tip_doc']; ?>
                                </td>
                                <td>
                                <?php echo "<a href='editar.php?documento=".$mostrar1['documento']."'>editar</a>";?>
                                <?php echo "<a href='eliminar.php?documento=".$mostrar1['documento']."'onclick='return confirmar()'> Eliminar </a>";?>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                                }
                                ?>
                    </table>
                </div> 
                <!-- TERMINA EL CODIGO DE MOSTRAR USUARIOS  -->
            </div>  
        <div>

            </div>
        </div>
    </div>
</body>

</html>



