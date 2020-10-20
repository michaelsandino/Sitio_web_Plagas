<?php

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $id_user = $_POST['id_user'];

    $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$id_user'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);
    
    include("../../disconnect.php");

?>