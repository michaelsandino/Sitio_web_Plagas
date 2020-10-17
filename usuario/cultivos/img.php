<?php

include("../../connect.php");

$nameimg = $_FILES['img']['name'];//obtiene el nombre
$file = $_FILES['img']['tmp_name']; //contiene el nombre

$route="plagas_img";

$route=$route."/".$nameimg; //imagenes/nombre.jpg
move_uploaded_file($file,$route);

$query = "INSERT INTO img values('".$route."')";

if(mysqli_query($connect, $query)) {
    echo '<script type="text/javascript">alert("Imagen guardada con exito"); window.location="../cultivos";</script>';

    return $successful;
}else{
    echo '<script type="text/javascript">alert("Error"); window.location="../cultivos";</script>';
}

include("../../disconnect.php");
?>


