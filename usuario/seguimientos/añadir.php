<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $idCultivo = $_POST['idCultivo'];

    $estado="En espera";

    /* Consultamos si el usuario cuenta con un proceso de verificación pendiente. */

    $review = $review="SELECT * FROM cultivo c, solicitud_proyecto s, solicitud_plaga p, solicitud_tratamiento t  WHERE (c.stado_c='En espera' AND c.idCultivo='s.id_cultivofk' AND s.evaluador_sp='$user_email') OR (p.evaluador_plag = '$user_email' AND p.stado_plag='En espera') OR (t.evaluador_T = '$user_email' AND t.stado_T='En espera')";
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    $check = $review->num_rows;
    if($check>0){
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
                La solicitud no ha sido añadida debido a que cuenta con procesos de verificación pendientes.  
                </div>';
    }else{

        /* Consultamos el estado del cultivo para saber si la solicitud hace referencia al cultivo y posteriomenete actulizar la solicitud para ser agregada a la lista del jurado*/

        $consult1="SELECT * FROM cultivo WHERE idCultivo='$idCultivo' and stado_c='$estado'";
        $result1 = mysqli_query($connect,$consult1) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        $check1=mysqli_fetch_row($result1);
        if ($check1) {
            $id_cultivo = $check1[0]; 

            $update = "UPDATE solicitud_proyecto SET evaluador_sp='$user_email' WHERE id_cultivofk='$id_cultivo'";
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');


        }

        /* Consultamos el estado del la plaga para saber si la solicitud hace referencia al plaga y posteriomenete actulizar la solicitud para ser agregada a la lista del jurado */

        $consult2="SELECT * FROM cultivo c, plagas p WHERE c.idCultivo=$id_cultivo AND p.id_cultivo=$id_cultivo and p.stado_p='$estado'";
        $result2 = mysqli_query($connect,$consult2) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        while($view2 = mysqli_fetch_array($result2)){
            
                $id_plaga = $view2['id_plagas']; 

                $update = "UPDATE solicitud_plaga SET evaluador_plag='$user_email' WHERE id_plagaSolict='$id_plaga'";
                $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
        }

        /* Consultamos el estado del tratamiento para saber si la solicitud hace referencia al tratamiento y posteriomenete actulizar la solicitud para ser agregada a la lista del jurado */
        
        $consult3="SELECT * FROM cultivo c, plagas p, tratamiento t WHERE c.idCultivo=$id_cultivo and p.id_cultivo=$id_cultivo and p.id_plagas=t.id_plaga and t.stado_t='$estado'";
        $result3 = mysqli_query($connect,$consult3) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        while($view3 = mysqli_fetch_array($result3)){
            
            $id_tratamiento = $view3['idTratamiento']; 

            $update = "UPDATE solicitud_tratamiento SET evaluador_T='$user_email' WHERE id_tatamientos='$id_tratamiento'";
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
        }

        echo '<div class="alert alert-success text-center mt-3" role="alert">
            La solicitud ha sido añadida con exito a su lista de seguimientos.  
            </div>';
        
    }


include("../../disconnect.php");
?>