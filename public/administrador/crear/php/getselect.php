<?php
    if(isset($_POST['tipoDeSelect'])) {
        require '../../../../php/conexion.php';

        $tipo_de_select = $_POST['tipoDeSelect'];

        switch($tipo_de_select) {
            case "modelo": 
                $sql2 = "SELECT * FROM modelo";
                $query2 = mysqli_query($mysqli, $sql2);
                                                                        
                while($row3 = mysqli_fetch_array($query2)) {
                    $json[] = array(
                        'id_modelo' => $row3['id_modelo'],
                        'nom_modelo' => $row3['nom_modelo']
                    );
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;

                break;
            case "marca": 
                $sql2 = "SELECT * FROM marca";
                $query2 = mysqli_query($mysqli, $sql2);
                                                                        
                while($row3 = mysqli_fetch_array($query2)) {
                    $json[] = array(
                        'id_marca' => $row3['id_marca'],
                        'nom_marca' => $row3['nom_marca']
                    );
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;

                break;
            case "tipo_vehiculo":
                $sql2 = "SELECT * FROM tipo_vehiculo";
                $query2 = mysqli_query($mysqli, $sql2);

                while($row3 = mysqli_fetch_array($query2)) {
                    $json[] = array(
                        'id_tipo_vehiculo' => $row3['id_tipo_vehiculo'],
                        'nom_tipo_vehiculo' => $row3['nom_tipo_vehiculo']
                    );
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;

                break;
            case "color":
                $sql2 = "SELECT * FROM color";
                $query2 = mysqli_query($mysqli, $sql2);

                while($row3 = mysqli_fetch_array($query2)) {
                    $json[] = array(
                        'id_color' => $row3['id_color'],
                        'nom_color' => $row3['nom_color']
                    );
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;

                break;
        }
    } else {
        echo "Ups, ha ocurrido un error";
    }
?>