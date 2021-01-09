<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $solicitud = $_POST['solicitud'];

    $update = "UPDATE solicitud_tratamiento SET evaluador_T='$user_email' WHERE id_solicT='$solicitud'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
            La solicitud ha sido añadida con exito a su lista de seguimientos.  
            </div>';
    }

include("../../disconnect.php");
?>