<?php

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo' AND (stado_c='Rechazado' OR stado_c='Pendiente')";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    if (!$json) {
        echo "invalid_user";
    }else{
        echo json_encode($json);
    }

    
    
    include("../../disconnect.php");

?>