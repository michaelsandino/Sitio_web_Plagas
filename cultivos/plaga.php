<?php

include("../connect.php");

    $plaga = $_POST['plaga'];

    /* Consultar las plagas con el estado activo - Han sido avalados previamente */
    $consult="SELECT * FROM plagas WHERE id_plagas='$plaga' AND stado_p='Activo'"; 
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