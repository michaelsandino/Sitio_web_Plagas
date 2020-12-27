<?php

    include("../../connect.php");

    $id_usu = $_POST['ideUsu'];
    $idFormacion = $_POST['id'];

    $consult="SELECT * FROM formacionapp WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    if (!$json) {
        echo 'invalid_user';
    }else{
        echo json_encode($json);
    }
    
    include("../../disconnect.php");

?>