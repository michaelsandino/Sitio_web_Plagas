<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $idSolicitante = $_SESSION['user'];

    $insert = "INSERT INTO solicitud_cuenta value(null,'$idSolicitante','Revisión',NULL)";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud enviada con éxito. 
        </div>';
    }
    
include("../../disconnect.php");

?>