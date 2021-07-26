<?php


include_once("../../../../php/conexion.php");

$grafica = new Grafica($mysqli, $_POST['idZona']);
$grafica->graficarCuposZonaParqueo();

    
class Grafica{

    public function __construct($conexion, $idZona)
    {
        $this->conexion = $conexion;
        $this->idZona = $idZona;
    }

    public function graficarCuposZonaParqueo() 
    {
        if($this->idZona == 0 or $this->idZona == '0') {
            $idZona = $this->consultarPrimeraZona();
        } else {
            $idZona = $this->idZona;
        }

        $informacionZonaParqueo = $this->consultarInformacionZonaParqueo($idZona);
        $cuposDisponibles = $this->consultarCuposDisponibles($idZona);
        $cuposOcupados = $this->consultarCuposOcupados($idZona);

        $json[] = array(
            'id_zona' => $idZona,
            'nom_tip_zona' => $informacionZonaParqueo['nom_tip_zona'],
            'nom_estado' => $informacionZonaParqueo['nom_estado'],
            'cupos_disponibles' => $cuposDisponibles,
            'cupos_ocupados' => $cuposOcupados,
            'cupos_totales' => $cuposDisponibles + $cuposOcupados
        );

        $jsonstring = json_encode($json);
        echo $jsonstring;

    }

    public function consultarInformacionZonaParqueo($idZona) 
    {
        $sql = "SELECT zona_parqueo.id_zona, tipo_zona.nom_tip_zona, estado.nom_estado FROM zona_parqueo, tipo_zona, estado WHERE zona_parqueo.id_zona = '$idZona' AND zona_parqueo.id_tip_zona = tipo_zona.id_tip_zona AND zona_parqueo.id_estado = estado.id_estado";
        $query = mysqli_query($this->conexion, $sql);

        return mysqli_fetch_assoc($query);
    }

    public function consultarCuposDisponibles($idZona) 
    {
        $sql = "SELECT * FROM detalle_cupos WHERE id_zona = '$idZona' AND id_estado = '4'";
        $query = mysqli_query($this->conexion, $sql);

        return mysqli_num_rows($query);
    }

    public function consultarCuposOcupados($idZona) 
    {
        $sql = "SELECT * FROM detalle_cupos WHERE id_zona = '$idZona' AND id_estado = '5'";
        $query = mysqli_query($this->conexion, $sql);

        return mysqli_num_rows($query);
    }

    public function consultarPrimeraZona() 
    {
        $sql = "SELECT MIN(id_zona) AS id_zona FROM zona_parqueo";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado['id_zona'];
    }

}


?>