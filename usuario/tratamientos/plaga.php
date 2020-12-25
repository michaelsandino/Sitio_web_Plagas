<?php

include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];

    $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'"; 
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

include("../../disconnect.php");

?>