<?php
$documento=$_GET['documento'];
include("../../../../php/conexion.php");

$sql="DELETE FROM usuario WHERE documento='$documento'";
$resul=mysqli_query($mysqli,$sql);

if($resul){
    echo'<script type="text/javascript">    
            window.location.href="../usuarios.php";
                    </script>';
}else{
    echo'<script type="text/javascript">
                alert("los datos no fueron eliminados correctamente");
                window.location.href="../usuarios.php";
                </script>';
}

?>