<?php

include("../connect.php");

    $cultivo = $_POST['cultivo'];

    /* Consultar los cultivos con el estado activo - Han sido avalados previamente */
    $consult="SELECT * FROM cultivo WHERE  idcultivo='$cultivo' AND stado_c='Activo'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Chequeamos si se encontro algun resultado */
    $check = $result->num_rows;

    if ($check) {
        while ($a = mysqli_fetch_assoc($result)) {
            $json=$a;
        }
        echo json_encode($json);
    }

    

include("../disconnect.php");

?>