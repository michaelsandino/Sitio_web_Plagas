<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user'];
    $idCultivo = $_POST['idCultivo'];

    $cumplimiento = $_POST['cumplimiento'];
    $nota = $_POST['nota'];
    date_default_timezone_set("America/Bogota");
    $fechaActual = date('d-m-Y');

    $id_solicP = $_POST['id_solicP'];

    /* Actualizar estado del cultivo */
    $update = "UPDATE cultivo SET stado_c='$cumplimiento' WHERE idCultivo='$idCultivo'";
    $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    /* Actualizar estado de la solicitud del cultivo */
    $update = "UPDATE solicitud_proyecto SET fech_fin='$fechaActual', stado_sp='$cumplimiento', nota_sp='$nota' WHERE id_solicP='$id_solicP' AND id_cultivofk='$idCultivo'AND stado_sp='Revisión' AND evaluador_sp='$user_email'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
    
     if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud actualizara con éxito. 
        </div>';
     }

    include("../../disconnect.php");

?>