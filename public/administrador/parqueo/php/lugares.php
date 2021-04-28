<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
<?php
  include("../../../../php/conexion.php");
  $id_cupo = $_POST['id_cupo'];

  $cupos = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '$id_cupo'";
  $resul = $mysqli->query($cupos);
  $infoZona = mysqli_fetch_assoc($resul);

  echo "<div class='parking'>";
  for ($i=1; $i <= $infoZona['cupos']; $i++) 
    {
      $cupos= "<a id='".$i."'  class='fas fa-parking'><br>";
      echo $cupos;
      echo $i;
      
    }
    echo "</div>";
?>