<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $solicitud = $_POST['solicitud'];
    
    $review = $review="SELECT c.id_solicP, p.id_plagaSolict, t.id_tatamientos FROM solicitud_proyecto c, solicitud_plaga p, solicitud_tratamiento t  WHERE (c.evaluador_sp = '$user_email' AND stado_s='En espera') OR (p.evaluador_plag = '$user_email' AND stado_plag='En espera') OR (t.evaluador_T = '$user_email' AND stado_t='En espera')";
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $check= $connect->affected_rows;
    if($check>0){
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
                La solicitud no ha sido añadida debido a que cuenta con un proceso de verificación pendiente.  
                </div>';
    }else{
        $update = "UPDATE solicitud_proyecto SET evaluador_sp='$user_email' WHERE id_solicP='$solicitud'";
        $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
                La solicitud ha sido añadida con exito a su lista de seguimientos.  
                </div>';
        }
    }
        

include("../../disconnect.php");
?>