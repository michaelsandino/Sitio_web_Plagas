<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user'];
    $id_plagas = $_POST['id_plagas'];

    $cumplimiento = $_POST['cumplimiento'];
    $nota = $_POST['nota'];
    date_default_timezone_set("America/Bogota");
    $fechaActual = date('d-m-Y');

    $id_solicPlag = $_POST['id_solicPlag'];

    /* Actualizar estado de la plaga */
    $update = "UPDATE plagas SET stado_p='$cumplimiento' WHERE id_plagas='$id_plagas'";
    $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    /* Actualizar estado de la solicitud de la plaga */
    $update = "UPDATE solicitud_plaga SET fech_finPlag='$fechaActual', stado_plag='$cumplimiento', nota_plag='$nota' WHERE id_solicPlag='$id_solicPlag' AND id_plagaSolict='$id_plagas' AND stado_plag='Revisión' AND evaluador_plag='$user_email'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
    
     if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Solicitud actualizara con éxito. 
        </div>';
     }

    include("../../disconnect.php");

?>