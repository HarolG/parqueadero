<?php
include_once("conexion.php");
?>
<!doctype html>
<html lang="es-ES">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>Sistema de Mensajes Privados TUNTORIALES</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>


<?php
if(isset($_GET['id'])) {

  $s = "SELECT * FROM mensajes WHERE id = '".$_GET['id']."'";
  $resul=mysqli_query($mysqli,$s);
  $row=mysqli_fetch_array($resul);

  $actualizar = "UPDATE mensajes SET leido = 0 WHERE id = '".$_GET['id']."'";
  $res=mysqli_query($mysqli,$actualizar);
?>

De: <?php echo $row['de']; ?>
<br><br>

Asunto: <?php echo $row['titulo']; ?>
<br><br>

Mensaje: <?php echo $row['mensaje']; ?>
<br><br>
<a href="../buzon.php">volver</a>
<?php
}
?>


</body>
</html>

