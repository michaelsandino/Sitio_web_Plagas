<?php

    include("../../connect.php");

    $id = $_POST['id'];
   
    $delete = "DELETE FROM cultivo WHERE idCultivo='$id'";
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