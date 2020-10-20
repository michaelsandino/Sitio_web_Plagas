<?php

    include("../../connect.php");

    $id = $_POST['id'];
   
    $delete = "DELETE FROM formacionapp WHERE idFormacion='$id'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if ($result){
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        Estudio eliminado con Exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } 

    include("../../disconnect.php");

?>