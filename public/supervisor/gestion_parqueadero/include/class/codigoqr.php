<?php

include("../../../../../php/conexion.php");

$codigoQR = new escanerCodigoQR($mysqli, $_POST['codigo'], $_POST['estado']);
// $codigoQR->consultarDatosUsuario($_POST['codigo'], $_POST['vehiculo']);
// $codigoQR->escanearEntradaSalida($_POST['codigo'], $_POST['estado']);

class escanerCodigoQR {

    public function __construct($conexion, $codigo, $estado) {

        $this->conexion = $conexion;
        $this->datosUsuario = $this->consultarDatosUsuario($codigo);

        if($estado == 'Inicial') {
            if($this->datosUsuario == 'badUsuario') {
                echo 'badUsuario';
            } else {
                echo 'okUsuario';
            }
        }

        if($estado == 'buscarVehiculo') {
            $this->vehiculosObtenidos = $this->obtenerTodoslosVehiculos($this->datosUsuario);
            echo $this->vehiculosObtenidos;
        }

        if($estado == 'registrarVehiculo') {
            if($_POST['tipoEntrada'] != 0) {

                $datosVehiculo = $this->obtenerDatosVehiculo($_POST['vehiculo']);

                #Entrada
                if($_POST['tipoEntrada'] == 1) {
                    $zonaDisponible = $this->obtenerZonaCompatible($datosVehiculo['id_tip_vehiculo']);

                    if($zonaDisponible != 'badZona') {
                        $cupoDisponible = $this->obtenerCupoDisponible($zonaDisponible);
                        $estadoRegistro = $this->registrarParqueadero($datosVehiculo, 'Entrada', $zonaDisponible, $cupoDisponible);
                    } else {
                        echo $zonaDisponible;
                    }
                } 
                #salida
                else if($_POST['tipoEntrada'] == 2){
                    $estadoRegistro = $this->registrarParqueadero($datosVehiculo, 'Salida', 'nulo', 'nulo');
                }
            } else {
                echo "badTipoEntrada";
            }
        }
        
    }

    private function consultarDatosUsuario($codigo) {
        $sql = "SELECT * FROM usuario WHERE usuario.codigo = $codigo";
        $query = mysqli_query($this->conexion, $sql);
        
        $numeroFilas = mysqli_num_rows($query);

        if($numeroFilas > 0) {
            return mysqli_fetch_assoc($query);
        } else {
            echo "badUsuario";
        }
    }

    private function obtenerTodoslosVehiculos($datosUsuario) {

        if($_POST['tipoEntrada'] != 0) {

            if($_POST['tipoEntrada'] == 1) {
                $estado = 4;
            } else if ($_POST['tipoEntrada'] == 2) {
                $estado = 5;
            }
    
            $documento = $datosUsuario['documento'];
            
            $sql = "SELECT * FROM detalle_vehiculo WHERE documento = $documento AND id_estado = $estado";
            $query = mysqli_query($this->conexion, $sql);
            $numero_vehiculos = mysqli_num_rows($query);
    
            if($query && $numero_vehiculos > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $json[] = array(
                        'id_deta_vehiculo' => $row['id_deta_vehiculo'],
                        'documento' => $row['documento'],
                        'placa' => $row['placa']
                    );
                }
            
                $jsonstring = json_encode($json);
                return $jsonstring;
            } else {
                echo "badVehiculo";
            }

        } else {
            echo "badTipoEntrada";
        }
    }

    function obtenerDatosVehiculo($vehiculo) {
        if($vehiculo != 0) {

            $sql = "SELECT * FROM detalle_vehiculo, vehiculo WHERE id_deta_vehiculo = $vehiculo";
            $query = mysqli_query($this->conexion, $sql);

            return mysqli_fetch_assoc($query);

        } else {
            echo "badVehiculo";
        }
    }

    function obtenerZonaCompatible($tipoVehiculo) {
        $sql = "SELECT MIN(id_zona) AS zona_disponible FROM zona_parqueo WHERE zona_parqueo.id_tip_zona = $tipoVehiculo AND zona_parqueo.id_estado = 1";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        $zonas_compatibles = mysqli_num_rows($query);

        if($zonas_compatibles > 0) {
            return $resultado['zona_disponible'];
        } else {
            echo "badZona";
        }
    }

    function obtenerCupoDisponible($zona) {
        $sql = "SELECT MIN(id_deta_cupos) AS cupo_disponible, MIN(nombre_cupo) AS nombre_cupo FROM detalle_cupos WHERE id_estado = 4 AND id_zona = $zona";
        $query = mysqli_query($this->conexion, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado;
    }

    function registrarParqueadero($datosVehiculo, $tipoEntrada, $zona, $cupo) {

        $placa = $datosVehiculo['placa'];
        $id_deta_vehiculo = $datosVehiculo['id_deta_vehiculo'];

        #Entrada
        if($tipoEntrada == 'Entrada') {
            $id_cupo = $cupo['cupo_disponible'];
            $cupo_disponible = $cupo['nombre_cupo'];

            $sql = "INSERT INTO registro_parqueadero (id_registro, id_deta_vehiculo, fecha, hora, hora_salida, id_zona, id_estado) VALUES (NULL, '$id_deta_vehiculo', CURRENT_DATE(), CURRENT_TIME(), NULL,'$zona', '6')";
            $query = mysqli_query($this->conexion, $sql);

            $sql2 = "UPDATE detalle_cupos SET id_deta_vehiculo = '$id_deta_vehiculo', id_estado = '5' WHERE id_zona = '$zona' AND id_deta_cupos = '$id_cupo'";
            $query2 = mysqli_query($this->conexion, $sql2);

            $sql3 = "UPDATE detalle_vehiculo SET id_estado = '5' WHERE detalle_vehiculo.id_deta_vehiculo = $id_deta_vehiculo";
            $query3 = mysqli_query($this->conexion, $sql3);

            if($query2 && $query && $query3) {
                 echo "El vehiculo con placas $placa ha sido parqueado en la zona $zona con el cupo $cupo_disponible";
            } else {
                 echo "Ups! algo ha fallado";
            }
        } 
        #Salida
        else if ($tipoEntrada == 'Salida') {

            $sql = "UPDATE registro_parqueadero SET id_estado = '7' WHERE id_deta_vehiculo = $id_deta_vehiculo AND id_estado = 6";
            $query = mysqli_query($this->conexion, $sql);

            $sql2 = "UPDATE detalle_cupos SET id_deta_vehiculo = NULL, id_estado = '4' WHERE id_deta_vehiculo = $id_deta_vehiculo AND id_estado = 5";
            $query2 = mysqli_query($this->conexion, $sql2);

            $sql3 = "UPDATE detalle_vehiculo SET id_estado = '4' WHERE detalle_vehiculo.id_deta_vehiculo = $id_deta_vehiculo";
            $query3 = mysqli_query($this->conexion, $sql3);

            if($query2 && $query && $query3) {
                 echo "Se ha registrado correctamente la salida";
            } else {
                 echo "Ups! algo ha fallado";
            }

        } else {
            echo 'badRegistro';
        }
    }

};

?>