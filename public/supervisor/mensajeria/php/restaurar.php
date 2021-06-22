<?php
include_once("../../../../php/conexion.php");

if(isset($_GET['id'])) {

$query = "UPDATE mensajes SET estado = 'normal' WHERE id = '".$_GET['id']."'";
$res = mysqli_query($mysqli,$query);
header("Location: ../buzon.php");

}
?>