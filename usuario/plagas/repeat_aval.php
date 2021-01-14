<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    $fechaActual = date('d-m-Y');
    
    $review="SELECT * FROM cultivo c, plagas p WHERE c.idCultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo' AND p.id_plagas='$id_plagas' AND c.idUsuCultivo='$idUsuCultivo'";
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Permite saber cuantas filas tiene la consulta*/
    $check=mysqli_fetch_row($review);

    if (!$check) {
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        invalid_user
        </div>'; 
    }else{
        $update = "UPDATE plagas SET stado_p='En espera' WHERE id_plagas='$id_plagas'";
        $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        $update = "UPDATE solicitud_plaga SET fech_iniPlag='$fechaActual',fech_finPlag=NULL,stado_plag='En espera',nota_plag=NULL,evaluador_plag=NULL WHERE id_plagaSolict='$id_plagas'";
        $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud de aval con éxito - Se actualizara dentro un momento el listado de Plagas. 
            </div>';
        }
   
    }
    
    include("../../disconnect.php");

?>