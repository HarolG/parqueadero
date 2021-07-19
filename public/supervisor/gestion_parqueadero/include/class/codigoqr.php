<?php

include("../../../../../php/conexion.php");

$codigoQR = new escanerCodigoQR($mysqli);
$codigoQR->consultarDatosUsuario($_POST['codigo'], $_POST['vehiculo']);
// $codigoQR->escanearEntradaSalida($_POST['codigo'], $_POST['estado']);

class escanerCodigoQR {

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->datosUsuario = "";
        $this->datosVehiculo = "";
    }

    function consultarDatosUsuario($codigo, $vehiculo) {
        $sql = "SELECT * FROM usuario WHERE usuario.codigo = $codigo";
        $query = mysqli_query($this->conexion, $sql);
        $this->datosUsuario = mysqli_fetch_assoc($query);
        $numeroFilas = mysqli_num_rows($query);

        if($numeroFilas > 0) {

            if($vehiculo == 0) {
                $this->obtenerVehiculos();
            } else if($vehiculo > 0){
                $this->datosVehiculo = $this->consultarDatosVehiculo($vehiculo);
                $estado = $this->consultarEstado($vehiculo);
                $zonaDisponible = $this->obtenerZonaCompatible($this->datosVehiculo['id_tip_vehiculo']);
                $cupoDisponible = $this->obtenerCupoDisponible($zonaDisponible);
                $this->escanearEntradaSalida($codigo, $estado, $zonaDisponible, $cupoDisponible);
            }

        } else {
            echo "Este codigo no se encuentra asociado a ninguna persona";
        }
    }

    function consultarEstado($id_deta_vehiculo) {
        $sql = "SELECT * FROM registro_parqueadero WHERE id_deta_vehiculo = $id_deta_vehiculo AND id_estado = 6";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);
        $numeroFilas = mysqli_num_rows($query);

        if($numeroFilas > 0) {
            $estado[] = array(
                "tipoEntrada" => "Salida",
                "idRegistro" => $resultado['id_registro'],
                "id_deta_vehiculo" => $resultado['id_deta_vehiculo'],
                "id_zona" => $resultado['id_zona'],
            );
            return $estado;
        } else {
            $estado[] = array(
                "tipoEntrada" => "Entrada"
            );
            return $estado;
        }
        
    }

    function obtenerVehiculos() {
        $documento = $this->datosUsuario['documento'];
        $sql = "SELECT * FROM detalle_vehiculo WHERE documento = $documento";
        $query = mysqli_query($this->conexion, $sql);

        while ($row = mysqli_fetch_array($query)) {
            $json[] = array(
                'id_deta_vehiculo' => $row['id_deta_vehiculo'],
                'documento' => $row['documento'],
                'placa' => $row['placa']
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    function consultarDatosVehiculo($id_deta_vehi) {
        $id_detalle_vehiculo = $id_deta_vehi;
        $sql = "SELECT * FROM detalle_vehiculo, vehiculo WHERE detalle_vehiculo.placa = vehiculo.placa AND detalle_vehiculo.id_deta_vehiculo = $id_detalle_vehiculo";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado;
    }

    function obtenerZonaCompatible($tipoVehiculo) {
        $sql = "SELECT MIN(id_zona) AS zona_disponible FROM zona_parqueo WHERE zona_parqueo.id_tip_zona = $tipoVehiculo AND zona_parqueo.id_estado = 1;";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado['zona_disponible'];
    }

    function obtenerCupoDisponible($zona) {
        $sql = "SELECT MIN(id_deta_cupos) AS cupo_disponible FROM detalle_cupos WHERE id_estado = 1 AND id_zona = $zona";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado['cupo_disponible'];
    }

    function escanearEntradaSalida($codigo, $estado, $zona, $cupo) {

        switch ($estado[0]['tipoEntrada']) {
            #En caso de que el estado sea habilitado quiere decir que va a salir, por ende se harán las consultas correspondientes para dar la salida
            case 'Salida':

                $id_registro = $estado[0]['idRegistro'];
                $id_deta_vehiculo = $estado[0]['id_deta_vehiculo'];

                $sql = "UPDATE detalle_cupos SET id_deta_vehiculo = NULL, id_estado = '1' WHERE detalle_cupos.id_deta_vehiculo = '$id_deta_vehiculo'";
                $query = mysqli_query($this->conexion, $sql);

                $sql3 = "UPDATE registro_parqueadero SET id_estado = '7', hora_salida = CURRENT_TIME() WHERE registro_parqueadero.id_registro = '$id_registro'";
                $query3 = mysqli_query($this->conexion, $sql3);

                if($query) {
                    echo "Se ha registrado correctamente la salida";
                } else {
                    echo "Ups! ha ocurrido un error.";
                }

                break;
            
            case 'Entrada':

                $id_deta_vehiculo = $this->datosVehiculo['id_deta_vehiculo'];
                $placa = $this->datosVehiculo['placa'];

                $sql = "INSERT INTO registro_parqueadero (id_registro, id_deta_vehiculo, fecha, hora, hora_salida, id_zona, id_estado) VALUES (NULL, '$id_deta_vehiculo', CURRENT_DATE(), CURRENT_TIME(), NULL,'$zona', '6')";
                $query = mysqli_query($this->conexion, $sql);

                $sql2 = "UPDATE detalle_cupos SET id_deta_vehiculo = '$id_deta_vehiculo', id_estado = '5' WHERE id_zona = '$zona' AND id_deta_cupos = '$cupo'";
                $query2 = mysqli_query($this->conexion, $sql2);

                if($query2 && $query) {
                     echo "El vehiculo con placas $placa ha sido parqueado en la zona $zona con el cupo $cupo";
                } else {
                     echo "Ups! algo ha fallado";
                }

                break;
            
            default:
                echo "Error";
                break;
        }

    }

};

?>