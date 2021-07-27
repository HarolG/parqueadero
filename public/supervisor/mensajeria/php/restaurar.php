<?php
include_once("../../../../php/conexion.php");

if(isset($_GET['id'])) {

$query = "UPDATE mensajes SET id_categoria = 11 WHERE id = '".$_GET['id']."'";
$res = mysqli_query($mysqli,$query);
header("Location: ../buzon.php");

}
?>