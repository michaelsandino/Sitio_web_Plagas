<?php

include("../../connect.php");

$id_plagas = $_POST['id_plagas'];
$idUsuCultivo = $_POST['idUsuCultivo'];

$consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
$result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

while ($a = mysqli_fetch_assoc($result)) {

    $id_cultivo = $a['id_cultivo'];
    $cons="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";  
    $cons = mysqli_query($connect,$cons) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($view = mysqli_fetch_assoc($cons)) {
        if ($view['nameRegional']) {
            $json=$a;
        }
    }

}
echo json_encode($json);

include("../../disconnect.php");

?>