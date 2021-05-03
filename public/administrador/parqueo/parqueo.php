<?php
    include("../../../php/conexion.php");

    if(isset($_SESSION['tipo']) && isset($_SESSION['nom']) && isset($_SESSION['ape']) && isset($_SESSION['pass']) ) {
        $tipoZona = $mysqli -> query ("SELECT id_zona, nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
        $zonas = $mysqli -> query ("SELECT id_zona,cupos,id_estado,nom_tip_zona,cupos_live FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de entrada</title>
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
                    <div class="enlaces">
                        <ul>
                            <li><strong><a href="http://centrodeindustria.blogspot.com">Centro de Industria y Construcción</a></strong></li>
                            <li><strong><a href="http://oferta.senasofiaplus.edu.co/sofia-oferta/">Portal de Sofia Plus</a></strong></li>
                        </ul>
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
                <div class="infoZonas">
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
                    </div><hr>
                <div class="filtro"><br>
                    <form method="post" class = "formFiltro">
                        <strong>Zona de Parqueo:</strong>
                        <select class = "tipoZona" id="tipoZona" name="tipoZona">
                            <option selected>Seleccione una opción </option>
                            <option value="0">Todas</option>
                                    <?php
                                        while ($resul = mysqli_fetch_array($tipoZona)) 
                                        { echo "<option value=$resul[id_zona]>$resul[nom_tip_zona]</option>";}
                                    
                                    ?>
                        </select>

                        <strong>Reporte de: </strong>
                        <select id='reporte' class='reporte' name='reporte'>
                            <option value="0" selected>Seleccione una opción </option>
                            <option value='1'>Hoy</option>
                            <option value='2'>Ayer</option>
                            <option value='3'>Hace una semana</option>
                            <option value='4'>Hace un mes</option>
                        </select>

                        <input type="submit" name="buscar"  class="btnReporte" value="Generar">
                    </form>
                </div>
                <div class="lugar">

                <?php
                 if(@$_POST['buscar']){
                    date_default_timezone_set('America/Bogota');

                    $tip_zona = $_POST['tipoZona'];
                    $tip_repo = $_POST['reporte'];

                  
                  
                    //REPORTES
                    $fecha_actual = date("Y-m-d");
                    //resto 1 día
                    $reDia = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
                    //resto 7 día
                    $reWeek = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
                    //resto 30 día
                    $reMes = date("Y-m-d",strtotime($fecha_actual."- 30 days")); 

                    if ($tip_repo == 1){
                        $tip_repo = $fecha_actual;
                    }
                    elseif($tip_repo == 2){
                        $tip_repo = $reDia;
                        $fecha_actual = $reDia;
                    }
                    elseif($tip_repo == 3){
                        $tip_repo = $reWeek;
                    }else{
                        $tip_repo = $reMes;
                    }

                    //tipo de zona que desea ver
                    if($tip_zona == 0){
                        //ver todas las zonas
                        $entradas = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE id_tip_entrada = 1 and fecha Between '$tip_repo' And '$fecha_actual'");
                                            
                    }else {
                        $entradas = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE id_tip_entrada = 1 and id_zona = '$tip_zona' and fecha Between '$tip_repo' And '$fecha_actual'");
                    }

                   
                    $resul = $entradas->num_rows;
                    if ($resul > 0)
                    {
                        $tabla= 
                        '
                            <div class="tablas">
                            <table>
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Fecha</th>
                                    <th>H. Ingreso</th>
                                    <th>H. Salida</th>
                                    <th>H. Estadia</th>
                                </tr>
                            </thead>';
                    
                        while($fila= $entradas->fetch_array())
                        {
                        $placa = $fila[2];
                        
                        $tabla.=
                            " <tbody>
                                <tr>
                                    <td>$placa</td>
                                    <td>$fila[3]</td>
                                    <td>$fila[4]</td>";
                                    $salida = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE placa = '$placa' and id_tip_entrada = 2");
                                    $resu = $salida->num_rows;
                                    if ($resu == 1){
                                        $infoSalida = mysqli_fetch_array($salida);
                                        $h_entrada = $fila[4];
                                        $h_salida = $infoSalida['hora'];
                    
                                        $hora1 = new DateTime($h_entrada);//Hora de entrada
                                        $hora2 = new DateTime($h_salida);//Hora de salida
                    
                                        //rango de horas dentro del parqueadero
                                        $intervalo = $hora2->diff($hora1);
                                        $tiempoR = $intervalo->format('%H:%i:%s');
                                        $tabla.= "<td>$infoSalida[4]</td>
                                                <td>$tiempoR</td>";
                                        
                                    }else{
                                        $h_entrada = $fila[4];
                    
                                        $hora1 = new DateTime($h_entrada);//Hora de entrada
                                        $hora2 = new DateTime(date("H:i:s"));//Hora de actual
                                        
                                        //rango de horas dentro del parqueadero
                                        $intervalo = $hora1->diff($hora2);
                                        $tiempoR = $intervalo->format('%H:%i:%s');
                                        $tabla.= "<td>En el Parqueadero</td>
                                                <td>$tiempoR</td>";
                                    }
                        $tabla.='</tr>
                                </tbody>';
                    
                        }
                    
                        $tabla.="</table></div>
                                <div class='numVehi'>
                                    <h2>N° DE VEHICULOS INGRESADOS</h2>";
                                    if($tip_zona == 0){
                                        $tabla.="<strong class='num'>$resul</strong><img src='../../../img/logo1.png' class='logo2'>";
                                    }
                                    elseif($tip_zona == 1){
                                        $tabla.="<i class='fas fa-car'><strong>$resul</strong></i>";
                                    }
                                    elseif($tip_zona == 2){
                                        $tabla.="<i class='fas fa-motorcycle'><strong>$resul</strong></i>";
                                    }else{
                                        $tabla.="<i class='fas fa-biking'><strong>$resul</strong></i>";
                                    }
                                     
                                    $tabla.="</div> ";
                                    } 
                                    else
                                    {
                                        $tabla="<i id='error' class='fas fa-exclamation-triangle'></i>
                                        <h3 class='sinDatos'>No se encontraron coincidencias con sus criterios de búsqueda.</h3>
                                        ";
                                    }
                        echo $tabla;
                    }
                ?>
                   </div>
            </div>
        </div>


    <script src="js/main.js">
    function actual() {
    var fecha = new Date($tiempoR); //Actualizar fecha.
    var hora = fecha.getHours(); //hora actual
    var minuto=fecha.getMinutes(); //minuto actual
    var segundo=fecha.getSeconds(); //segundo actual
    if (hora<10) { //dos cifras para la hora
       hora="0"+hora;
       }
    if (minuto<10) { //dos cifras para el minuto
       minuto="0"+minuto;
       }
    if (segundo<10) { //dos cifras para el segundo
       segundo="0"+segundo;
       }
    //ver en el recuadro del reloj:
    var mireloj = hora+" : "+minuto+" : "+segundo;	
            return mireloj; 
    }
    function actualizar() { //función del temporizador
    var mihora=actual(); //recoger hora actual
    var mireloj=document.getElementById("reloj"); //buscar elemento reloj
    mireloj.innerHTML=mihora; //incluir hora en elemento
    }
    setInterval(actualizar,1000); //iniciar temporizador
    
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