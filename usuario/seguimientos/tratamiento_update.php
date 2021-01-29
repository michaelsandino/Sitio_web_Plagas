<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user'];
    $idTratamiento = $_POST['idTratamiento'];

    $cumplimiento = $_POST['cumplimiento'];
    $nota = $_POST['nota'];
    date_default_timezone_set("America/Bogota");
    $fechaActual = date('d-m-Y');

    /* Actualizar estado del tratamiento */
    $update = "UPDATE tratamiento SET stado_t='$cumplimiento' WHERE idTratamiento='$idTratamiento'";
    $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    /* Actualizar estado de la solicitud del tratamiento */
    $update = "UPDATE solicitud_tratamiento SET fech_finT='$fechaActual', stado_T='$cumplimiento', nota_T='$nota' WHERE id_tatamientos='$idTratamiento' AND evaluador_T='$user_email'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
    
     if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud actualizara con éxito. 
        </div>';
     }

    include("../../disconnect.php");

?>