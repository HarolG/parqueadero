<?php 

//libreria PHPMailer para enviar correo electronico
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


function correo($correo, $nombreUsu, $clave_nueva){

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
		$mail->setFrom('parkin.system.adsi@gmail.com', 'Parking System - Actializacion de clave');
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
			<style>
			.carnet{
				width: 40%;
				height: 50%;
				margin: 10px;
				padding: 20px 30px;
				background-color: #F8F8F8;
			}
			.margen{
				padding: 50px;
				background-color: #EFEFEF;
			}

			.logo{
				width: 70%;
				height: 20%;
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

			
			</style>
		</head>
		<body>
		<div class="carnet">
			<div class="margen" id="codigo">
				<img class ="logo" src="https://i.ibb.co/7vwFLtz/Logo-negro.png" alt="Logo-negro">
				<div class="mensaje">
					<h2>ACTULIZACION DE CONTRASEÑA EXITOSO</h2>
					<h2>¡Hola Usuario'.$nombreUsu.'!</h2>
					<p>Has solicitado recuperar tu contraseña, por tal motivo Parking System a generado una nueva para ti,</p>
					<p><strong>Nueva Contraseña: </strong>'.$clave_nueva.'</p>
				</div>
			</div>
		</div>

		</body>
		</html>';

		$mail->send();

	} catch (Exception $e) {
		echo "Error Presentado: {$mail->ErrorInfo}";
	}

	echo '<script type="text/javascript">
            alert("La nueva contraseña ha sido enviada correctamente al correo registrado");
			window.location.href="../login.html";
            </script>';
}

?>