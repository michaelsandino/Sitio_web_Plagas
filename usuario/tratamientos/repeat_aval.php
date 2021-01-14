<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $idTratamiento = $_POST['idTratamiento'];
    $id_plaga = $_POST['id_plaga'];
    $id_cultivo = $_POST['id_cultivo'];
    $fechaActual = date('d-m-Y');
    
    $review="SELECT * FROM cultivo c, plagas p, tratamiento t WHERE c.idUsuCultivo='$idUsuCultivo' AND c.idCultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo' AND p.id_plagas='$id_plaga' AND t.id_plaga='$id_plaga' AND t.idTratamiento='$idTratamiento'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Permite saber cuantas filas tiene la consulta*/
    $check=mysqli_fetch_row($review);

    if (!$check) {
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
            invalid_user
            </div>';   
    }else{
        $update = "UPDATE tratamiento SET stado_t='En espera' WHERE idTratamiento='$idTratamiento'";
        $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        $update = "UPDATE solicitud_tratamiento SET fech_iniT='$fechaActual',fech_finT=NULL,stado_T='En espera',nota_T=NULL,evaluador_T=NULL WHERE id_tatamientos='$idTratamiento'";
        $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud de aval con exito - Se actualizara dentro un momento el listado de Tratamientos. 
            </div>';
        }
   
    }
    
    include("../../disconnect.php");

?>