<script src="https://kit.fontawesome.com/a90c49b6b2.js" crossorigin="anonymous"></script>
<?php
  include("../../../php/conexion.php");

  $tip_zona = $_POST['tip_zona'];

  $cupos = "SELECT * FROM zona_parqueo WHERE id_tip_zona = '$tip_zona'";
  $resul = $mysqli->query($cupos);
  $infoZona = mysqli_fetch_assoc($resul);

  echo "<div class='parking'>";
  for ($i=1; $i <= $infoZona['cupos']; $i++) 
    {
      $lugar = $i;
      $logo="<a id='".$lugar."' class='fas fa-parking'> $i<br>";
      echo $logo;

      $placa = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE lugar = '$lugar' and id_tip_entrada = 1 and id_zona = '$tip_zona' "); 
      $resul = $placa->num_rows;

      if ($resul == 1){
        $infoPlaca = mysqli_fetch_array($placa);
        $id_placa = $infoPlaca[2];
        $id_zona = $infoPlaca[5];
        echo $id_placa;
        echo " <form action='php/salida.php' method='POST' class='formRegistro'>
        <input type='hidden' name='placa' value='".$id_placa."'>
        <input type='hidden' name='zona' value='".$id_zona."'>
        <input type='submit' name='salida' value='Salida'></form>";
       
        

      }else{
        echo "Libre";
      }
      
    }
?>

<script>
  var botones = document.getElementsByClassName('fas fa-parking');

  for(var i = 0; i < botones.length; i++){
    botones[i].addEventListener('click', capturar);
  }

  function capturar(){
    console.log(this.id);
  }
</script>