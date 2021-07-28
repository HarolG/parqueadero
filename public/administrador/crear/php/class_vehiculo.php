<?php

require '../../../../php/conexion.php';

$vehiculo = new Vehiculo($_POST['placa'], $mysqli, $_POST['estado']);

class Vehiculo {

    public function __construct($placa, $conexion, $estado)
    {
        $this->conexion = $conexion;

        switch($estado) {

            case 'Consultar':

                $datosVehiculo = $this->consultarDatosVehiculo($placa);
                echo $datosVehiculo;
                
                break;
            
            case 'preEditar-datos':
                $datosVehiculo = $this->consultarDatosVehiculo($placa);
                echo $datosVehiculo;
                break;
            
            case 'preEditar-select':
                $selects = $this->consultarSelects();
                echo $selects;
                break;

            case 'Actualizar':
                echo $this->actualizarDatos($placa);
                break;

            case 'Eliminar':
                echo $this->eliminarRegistro($placa);
                break;
            
            case 'Propietarios':
                echo $this->consultarPropietarios($placa);
                break;

            default: 
                echo 'Error';
                break;
        }
    }

    public function actualizarDatos($placa) {
        $placaUpdate = $_POST['form_update_placa'];
        $form_update_modelo = $_POST['form_update_modelo'];
        $form_update_marca = $_POST['form_update_marca'];
        $form_update_color = $_POST['form_update_color'];
        $form_update_tipoVehiculo = $_POST['form_update_tipoVehiculo'];
        $form_update_anotacion = $_POST['form_update_anotacion'];

        $sql = "UPDATE vehiculo SET placa = '$placaUpdate', id_modelo = '$form_update_modelo', id_marca = '$form_update_marca', id_tip_vehiculo = '$form_update_tipoVehiculo', id_color = '$form_update_color', anotaciones = '$form_update_anotacion' WHERE vehiculo.placa = '$placa'";
        $query = mysqli_query($this->conexion,$sql);

        if($query) {
            return "actualizarOk";
        } else {
            return "actualizarBad";
        }
    }

    public function consultarPropietarios($placa) {
        $sql = "SELECT * FROM usuario, detalle_vehiculo, tipo_documento WHERE tipo_documento.id_tip_doc = usuario.id_tip_doc AND usuario.documento = detalle_vehiculo.documento AND detalle_vehiculo.placa = '$placa'";
        $query = mysqli_query($this->conexion,$sql);

        if($query){
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_array($query)) {
                    $json[] = array(
                        'documento' => $row['documento'],
                        'codigo' => $row['codigo'],
                        'nombre' => $row['nombre'],
                        'apellido' => $row['apellido'],
                        'edad' => $row['edad'],
                        'celular' => $row['celular'],
                        'direccion' => $row['direccion'],
                        'correo' => $row['correo'],
                        'nom_tip_doc' => $row['nom_tip_doc']
                    );
                }
                return json_encode($json);
            } else {
                return 'sinPropietarios';
            }
        } else {
            return 'badConsultaPropietario';
        }
    }

    public function consultarSelects() {
        $sqlModelo = "SELECT * FROM modelo";
        $queryModelo = mysqli_query($this->conexion, $sqlModelo);

        while($rowModelo = mysqli_fetch_array($queryModelo)) {
            $jsonModelo[] = array(
                'id_modelo' => $rowModelo['id_modelo'],
                'nom_modelo' => $rowModelo['nom_modelo'],
            );
        }

        $sqlMarca = "SELECT * FROM marca";
        $queryMarca = mysqli_query($this->conexion, $sqlMarca);
        
        while($rowMarca = mysqli_fetch_array($queryMarca)) {
            $jsonMarca[] = array(
                'id_marca' => $rowMarca['id_marca'],
                'nom_marca' => $rowMarca['nom_marca'],
            );
        }

        $sqlColor = "SELECT * FROM color";
        $queryColor = mysqli_query($this->conexion, $sqlColor);
        
        while($rowColor = mysqli_fetch_array($queryColor)) {
            $jsonColor[] = array(
                'id_color' => $rowColor['id_color'],
                'nom_color' => $rowColor['nom_color'],
            );
        }

        $sqlTipoVeh = "SELECT * FROM tipo_vehiculo";
        $queryTipoVeh = mysqli_query($this->conexion, $sqlTipoVeh);

        while($rowTipoVeh = mysqli_fetch_array($queryTipoVeh)) {
            $jsonTipoVeh[] = array(
                'id_tipo_vehiculo' => $rowTipoVeh['id_tipo_vehiculo'],
                'nom_tipo_vehiculo' => $rowTipoVeh['nom_tipo_vehiculo'],
            );
        }
        
        $resultadoGlobal = array_merge($jsonModelo, $jsonMarca, $jsonColor, $jsonTipoVeh);

        return json_encode($resultadoGlobal);
    }

    public function consultarDatosVehiculo($placa) 
    {
        $sql = "SELECT * FROM vehiculo, detalle_vehiculo, modelo, marca, tipo_vehiculo, color, estado WHERE vehiculo.id_modelo = modelo.id_modelo AND vehiculo.id_marca = marca.id_marca AND vehiculo.id_tip_vehiculo = tipo_vehiculo.id_tipo_vehiculo AND vehiculo.id_color = color.id_color AND detalle_vehiculo.id_estado = estado.id_estado AND detalle_vehiculo.placa = vehiculo.placa AND detalle_vehiculo.placa = '$placa'";
        $query = mysqli_query($this->conexion, $sql);
        $filas = mysqli_num_rows($query);

        if($filas > 0) {
            
            $resultado = mysqli_fetch_assoc($query);
            return json_encode($resultado);

        } else {
            return 'badConsulta';
        }
    }

    public function eliminarRegistro($placa) {
        $sql = "DELETE FROM vehiculo WHERE vehiculo.placa = '$placa'";
        $query = mysqli_query($this->conexion, $sql);

        $sql2 = "DELETE FROM detalle_vehiculo WHERE detalle_vehiculo.placa = $placa";
        $query2 = mysqli_query($this->conexion, $sql2);

        if($query) {
            if($query2) {
                return 'eliminarOk';
            } else {
                return 'eliminarBad';
            }
        } else {
            return 'eliminarBad';
        }

    }
}

?>