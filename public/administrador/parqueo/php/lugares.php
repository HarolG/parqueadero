<script language="javascript">

$(document).ready(function(){
  $("#reporte").change(function () {

    $("#reporte option:selected").each(function () {
      reee = $(this).val();
      $.post("lugares.php", { reee: reee });            
    });
  })
});


</script>

<?php
  include("../../../../php/conexion.php");
  date_default_timezone_set('America/Bogota');

  $tip_zona = $_POST['tip_zona'];
  $zonas = $mysqli -> query ("SELECT id_zona, nom_tip_zona FROM zona_parqueo, tipo_zona WHERE zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona and  tipo_zona.id_tip_zona = '$tip_zona'");
  $infoZona = mysqli_fetch_array($zonas);
  $zona = $infoZona['id_zona'];
  $nomZona = $infoZona['nom_tip_zona'];

  $filtro =" 
    <div class='filtro'>
      <strong>Reporte de: </strong>
      <select id='reporte' class='reporte' name='reporte'>
        <option value='1'>Hoy</option>
        <option value='2'>Ayer</option>
        <option value='3' selected>Hace una semana</option>
        <option value='4'>Hace un mes</option>
      </select>
      </div>
  ";

echo $filtro;


//REPORTES
$fecha_actual = date("Y-m-d");
//resto 1 día
$reDia = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
//resto 7 día
$reWeek = date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
//resto 30 día
$reMes = date("Y-m-d",strtotime($fecha_actual."- 30 days")); 

$entradas = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE id_tip_entrada = 1 and id_zona = '$zona' and fecha = '$fecha_actual'");

$resul = $entradas->num_rows;
if ($resul > 0)
{
	$tabla= 
	'<div class="tablas"><br>
    <table>
    <thead>
        <tr>
            <th>Placa</th>
            <th>Fecha</th>
            <th>H. Ingreso</th>
            <th>H. Salida</th>
            <th>H. Estadia</th>
        </tr>
    </thead>';

	while($fila= $entradas->fetch_array())
	{
    $placa = $fila[2];
    
		$tabla.=
		" <tbody>
            <tr>
                <td>$placa</td>
                <td>$fila[3]</td>
                <td>$fila[4]</td>";
                $salida = $mysqli -> query ("SELECT * FROM registro_parqueadero WHERE placa = '$placa' and id_tip_entrada = 2");
                $resu = $salida->num_rows;
                if ($resu == 1){
                  $infoSalida = mysqli_fetch_array($salida);
                  $h_entrada = $fila[4];
                  $h_salida = $infoSalida['hora'];

                  $hora1 = new DateTime($h_entrada);//Hora de entrada
                  $hora2 = new DateTime($h_salida);//Hora de salida

                  //rango de horas dentro del parqueadero
                  $intervalo = $hora2->diff($hora1);
                  $tiempoR = $intervalo->format('%H:%i:%s');
                  $tabla.= "<td>$infoSalida[4]</td>
                            <td>$tiempoR</td>";
                  
                }else{
                  $h_entrada = $fila[4];

                  $hora1 = new DateTime($h_entrada);//Hora de entrada
                  $hora2 = new DateTime(date("H:i:s"));//Hora de actual
                  
                  //rango de horas dentro del parqueadero
                  $intervalo = $hora1->diff($hora2);
                  $tiempoR = $intervalo->format('%H:%i:%s');
                  $tabla.= "<td>En el Parqueadero</td>
                            <td>$tiempoR</td>";
                }
    $tabla.='
            </tr>
        </tbody>
		';

	}

	$tabla.="</table></div>
    <div class='numVehi'>
      <h2>N° DE VEHICULOS INGRESADOS</h2>
      <h3>$nomZona</h3>
    ";
    if($tip_zona == 1){
      $tabla.=" <i class='fas fa-car'>$resul</i>";
    }
    else if ($tip_zona == 2){
      $tabla.=" <i class='fas fa-motorcycle'>$resul</i>";
    }else{
      $tabla.=" <i class='fas fa-biking'>$resul</i>";
    }
    
   $tabla.="</div>";
} 
else
{
  $tabla="<i id='error' class='fas fa-exclamation-triangle'></i>
  <h3 class='sinDatos'>No se encontraron coincidencias con sus criterios de búsqueda.</h3>
  ";
}


echo $tabla;
 
?>