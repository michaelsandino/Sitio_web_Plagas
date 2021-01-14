<?php

include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_cultivo = $_POST['id_cultivo'];

    $consult="SELECT * FROM cultivo WHERE idUsuCultivo='$idUsuCultivo' AND idcultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

include("../../disconnect.php");

?>