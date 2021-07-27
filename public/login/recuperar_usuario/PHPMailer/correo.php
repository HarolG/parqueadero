<?php 

//libreria PHPMailer para enviar correo electronico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


function correo($correo, $codigo, $nombre){
	$mail = new PHPMailer(true);
	$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'parkin.system.adsi@gmail.com';                     //SMTP username
		$mail->Password   = 'ADSI2060060';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('parkin.system.adsi@gmail.com', 'Parking System - Codigo de Barras');
		$mail->addAddress($correo, 'prueba');     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Asunto Importante';
		$mail->Body    = '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="barcode.php">
			<style>
			.carnet{
				width: 60%;
				height: 80%;
				margin: 50px;
				padding: 20px 30px;
				background-color: #F8F8F8;
			}
			.margen{
				padding: 50px;
				background-color: #EFEFEF;
			}

			.logo{
				width: 80%;
				height: 30%;
				margin: 5px 50px;
			}

			h1, h2, h3, p{
				font-family: "Poppins", sans-serif;
				text-align: center;
				color: black;
			}
			img{
				margin: 30px 160px;
				width: 35%;
			}

			ol, h4{
				font-family: "Poppins", sans-serif;
				color: black;
			}

			.descarga{
				width: 50%;
				cursor: pointer;
				display: block;
				border-radius: 25px;
				outline: none;
				border: none;
				background-image: linear-gradient(to right, #325ebe, #3dd338, #e7eb26);
				background-size: 200%;
				font-size: 1rem;
				transition: .5s;
				font-family: "Poppins", sans-serif;
				padding: 12px;
				margin: 50px 100px 10px 130px;
				text-align: center;
			}

			.descarga:hover{
				background-position: right;
			}

			
			</style>
		</head>
		<body>
		<div class="carnet">
			<div class="margen" id="codigo">
				<img class ="logo" src="https://i.ibb.co/7vwFLtz/Logo-negro.png" alt="Logo-negro">
				<div class="mensaje">
					<h2>¡Bienvenido '.$nombre.'!</h2>
					<p>Ahora formas parte del Sistema Informático para el Control de Entradas y Salidas de Vehículos - Parqueadero SENA.</p><br>
					<p>Con el siguiente código de barras podrás ingresar tu vehículo automotor o no automotor al parqueadero del Centro de Industria y la Construcción, Regional Tolima, pero recuerda cumplir con todos los requisitos y documentos para el registro de tu vehículo.</p>

					<img  alt="Barcode Generator TEC-IT" src="https://barcode.tec-it.com/barcode.ashx?data='.$codigo.'"/>

					<div class="info_registro">
						<h4>Requisitos Necesarios: </h4>
						<ol>
							<li>Tener algún cargo en dicha institución (aprendiz, instructor, administrativo, etc.) y en estado activo.</li>
						</ol>
						<h4>Documentos:</h4>
						<ol>
							<li>Tarjeta de propiedad del vehículo a registrar (Formato .jpeg/.jpg/.png/)</li>
							<li>Imagen del vehículo a registrar. (Formato .jpeg/.jpg/.png/)</li>
						</ol>
					</div>

					<div class="descarga">
						<a style="color: white; text-decoration: none;" download href="https://barcode.tec-it.com/barcode.ashx?data='.$codigo.'">Descargar Código de Barras</a>
					</div>
				</div>
			</div>
		</div>

		</body>
		</html>';

		$mail->send();

	} catch (Exception $e) {
		echo "Error Presentado: {$mail->ErrorInfo}";
	}
}
?>