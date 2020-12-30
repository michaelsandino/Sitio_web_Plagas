<?php

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";  
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    $delete = "DELETE FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">El cultivo seleccionado no puede ser eliminado debido a que esta cuenta con una o más plagas registradas.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  
    $check = $connect->affected_rows;

    if ($check) {

        $namePhoto=mysqli_fetch_row($consult);
        $namePhoto = $namePhoto[5]; 
        unlink('cultivos_img/'.$namePhoto); 
    
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Cultivo eliminado con Exito - Se actualizara dentro un momento el listado de cultivos.
        </div>';
        
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        invalid_user
        </div>';
    }

   

    include("../../disconnect.php");

?>

