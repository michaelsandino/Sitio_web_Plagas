<?php

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];

    $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo'";  
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
   
    while($view = mysqli_fetch_array($consult))
    {
        unlink('plagas_img/'.$view['imagenC']); 
    }

    $delete = "DELETE FROM cultivo WHERE idCultivo='$id_cultivo'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error - Revisar que el cultivo seleccionado no tenga asignado una o más plagas.</div>');

    
    if ($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Cultivo eliminado con Exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } 

    include("../../disconnect.php");

?>