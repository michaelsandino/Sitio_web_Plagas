<?php

    include("../../connect.php");

    $idTratamiento = $_POST['idTratamiento'];
   
    $delete = "DELETE FROM tratamiento WHERE idTratamiento='$idTratamiento'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if ($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Tratamiento eliminado con Exito - Se actualizara dentro un momento el listado de estudios.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } 

    include("../../disconnect.php");

?>