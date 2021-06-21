<?php
include_once("php/conexion.php");

if(isset($_GET['id'])) {

$query = "UPDATE mensajes SET estado = 'eliminado' WHERE id = '".$_GET['id']."'";
$res = mysqli_query($mysqli,$query);
header("Location: index.php");

}
?>