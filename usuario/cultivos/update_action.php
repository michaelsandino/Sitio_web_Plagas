<?php
    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $id_user = $_POST['id_user'];

    $nameR = $_POST['nameR'];
    $nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
        
    $update = "UPDATE cultivo SET nameRegional='$nameR', nameCientifico='$nameC',descripCultivo='$descrip'
    WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$id_user'";
    
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error - Revisar que el cultivo seleccionado no tenga asignado una o más plagas.</div>');

    include("../../disconnect.php");

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información actualizada con exito - Sera redireccionado en un momento.
        </div>';
    }  
?>
