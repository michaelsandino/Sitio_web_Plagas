<?php

include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_plaga = $_POST['id_plaga'];
    $id_cultivo = $_POST['id_cultivo'];

    $consult="SELECT * FROM plagas p, cultivo c WHERE p.id_plagas='$id_plaga' AND p.id_cultivo='$id_cultivo' AND c.idCultivo='$id_cultivo' AND c.idUsuCultivo='$idUsuCultivo'"; 
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

include("../../disconnect.php");

?>