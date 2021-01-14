<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $idSolicitante = $_SESSION['user'];

    $update = "UPDATE solicitud_cuenta SET stado_s='Revisión',Nota_s=NULL WHERE idSolicitante='$idSolicitante'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud enviada con éxito. 
        </div>';
    }
    
include("../../disconnect.php");

?>