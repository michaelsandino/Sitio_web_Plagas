<?php

include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $consult="SELECT * FROM plagas p, cultivo c WHERE p.id_plagas='$id_plagas' AND p.id_cultivo='$id_cultivo' AND c.idCultivo='$id_cultivo'"; 
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

include("../../disconnect.php");

?>