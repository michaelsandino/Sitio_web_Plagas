<?php 

include("../../connect.php");

    $idSolicitante = $_POST['idSolicitante'];

    $insert = "INSERT INTO solicitud_cuenta value(null,'$idSolicitante','Revisión',NULL)";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud enviada con exito. 
        </div>';
    }
    
include("../../disconnect.php");

?>