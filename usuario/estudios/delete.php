<?php

    include("../../connect.php");

    $idFormacion = $_POST['idFormacion'];
    $id_usu = $_POST['id_usu'];
   
    $consult="SELECT * FROM formacionapp WHERE idFormacion='$idFormacion' AND id_usu='$id_usu'";
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    while($view = mysqli_fetch_array($consult))
    {
        unlink('estudios_pdf/'.$view['soporte']); 
    }

    $delete = "DELETE FROM formacionapp WHERE idFormacion='$idFormacion' AND id_usu='$id_usu'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if ($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Estudio eliminado con Exito - Se actualizara dentro un momento el listado de estudios.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } 

    include("../../disconnect.php");

?>