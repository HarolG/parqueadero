<?php

	include ("../../../php/conexion.php");

	$query = "SELECT * FROM usuario 
				INNER JOIN tipo_usuario ON usuario.id_tip_usu = tipo_usuario.id_tip_usu 
				INNER JOIN tipo_documento ON usuario.id_tip_doc= tipo_documento.id_tip_doc 
				INNER JOIN estado ON usuario.id_estado= estado.id_estado";
	$resultado = mysqli_query($conexion, $query);

	if(!$resultado){
		die("ERROR");
	}else {
		while ( $data = mysqli_fetch_assoc($resultado)) {
			$arreglo["data"][] = $data;
		}
		echo json_encode($arreglo);
	}

	mysqli_free_result($resultado);
	mysqli_close($conexion);