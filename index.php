<?php
include_once("php/conexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="img/logo.ico" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
    <title>Parking System</title>
</head>
<body>
    <div class="contenedor-portada">
        <div class="capa-gris">
            <a href="public/login/login.html"><strong>Inicio de Sesión&nbsp;&nbsp;<i
                        class="fas fa-sign-in-alt"></i></strong></a>
            <div class="info">
                <div class="portada">
                    <img src="img/logo_sena.png" class="logo_sena" alt="">
                    <img src="img/Logo_parking_2.0.png" class="logo_ps" alt="">
                </div>

                <h1>Sistema Informático para el Control de Entradas y Salidas de Vehículos </h1>
                <h2>PARQUEADERO SENA</h2>
                <a href="#about"><input type="button" class="btnIndex" value="Conocer Más "></a>
            </div>
        </div>
    </div>
    <div class="about" id="about">
        <div class="text">
            <video autoplay muted loop>
                <source src="img/videos/Proyecto.mp4" type="video/mp4">
            </video>
        </div>
        <div class="vista">
            <p>PARKING SYSTEM es el Sistema Informático diseñado para el Control de Entradas y Salidas del Parqueadero
                Automotor del Centro de Industria y Construcción SENA, Ibagué – Tolima. <br><br>

                Nació como propuesta de proyecto formativo en el año 2020 por los aprendices del Tecnólogo en Análisis y
                Desarrollo en Sistemas de Información N° Ficha 2060060, y su principal objetivo es agilizar el proceso
                de ingreso de vehículos automotores y no automotores, realizado por los agentes de vigilancia del centro
                de formación.
            </p>
        </div>
    </div>

    <div class="contenedor-servicios">
        <div class="servicios">
            <strong>
                <-- SERVICIOS -->
            </strong>
        </div>
        <div class="entry_exit">
            <i class="fas fa-door-open"></i><br>
            <label for="">Scaner de Código de Barras para Entrada y Salida de Vehículos </label>
        </div>
        <div class="user">
            <i class="fas fa-user-shield"></i><br>
            <label for="">Almacenamiento y Gestión de Información de Usuarios </label>
        </div>
        <div class="parking">
            <i class="fas fa-parking"></i><br>
            <label for="">Asignación de Lugar de Parqueo</label>
        </div>

        <div class="graficas">
            <i class="fas fa-chart-pie"></i><br>
            <label for="">Estadísticas en Tiempo Real Sobre Cupos Disponibles de Parqueo</label>
        </div>
    </div>
    <div class="about">
         <div class="text">
            <video autoplay muted loop>
                <source src="img/videos/diagrama.mp4" type="video/mp4">
            </video>
        </div>
        <div class="sena">
            <div class="capa-verde">

            </div>
        </div>
    </div>
    <div class="about2">
        <div class="cajita">
            <h2>C O N T A C T E N O S</h2>
            <form method="post" action="">
                <label for="" class="labels">Correo Electronico:</label>
                <input type="email" name="de" class="inputs" required autocomplete="off">
                <label for="" class="labels">Asunto:</label>
                <input type="text" name="titulo" class="inputs" required autocomplete="off">
                <label for="" class="labels" class="inputs">Mensaje:</label>
                <textarea name="mensaje" class="textarea" required></textarea>
                <input type="hidden" name="guardar" value="Enviar Mensaje">
                <input type="submit" value="Enviar Mensaje" class="boton">
            </form>
        </div>
        <?php
  
         if(isset($_POST['guardar'])) {

            $de = $_POST['de'];
            $titulo = $_POST['titulo'];
            $mensaje = $_POST['mensaje'];

            $sql="INSERT INTO mensajes (titulo , mensaje , de , fecha , leido , id_categoria) VALUES ('$titulo' , '$mensaje' , '$de' , NOW() , 1 ,11)";
                            
            $resul=mysqli_query($mysqli,$sql);
		    if ($resul) {
			    echo "<script language='JavaScript'>
						alert('Se envio el mensaje correctamente');
					</script>";  
		    }else{  
                echo "<script language='JavaScript'>
                    alert('El mensaje no fue enviado');
                </script>"; 
            }
        }else {     
            mysqli_close($mysqli);
            ?>
        <?php
        }
            ?>

    </div>
    <footer>
        <h2>D E S A R R O L L A D O R E S</h2><br>
        <div class="contenedor-footer">
            <div class="content-foo">
                <label>Ever Moreno</label><br>
                <p>eamoreno117@misena.edu.co</p>
            </div>
            <div class="content-foo">
                <label>Camilo Nieto</label>
                <p>csnieto29@misena.edu.co</p>
            </div>
            <div class="content-foo">
                <label>Harol Guzman</label>
                <p>hsguzman83@misena.edu.co</p>
            </div>
            <div class="content-foo">
                <label>Daniela Nieto</label>
                <p>dnieto57@misena.edu.co</p>
            </div>
            <div class="content-foo">
                <label>Jhoan Sanchez</label>
                <p>jdsanchez3019@misena.edu.co</p>
            </div>
        </div>
        <h2 class="titulo-final">&copy; Servicio Nacional de Aprendizaje SENA | Centro de Industria y Construcción</h2>
    </footer>
</body>

</html>