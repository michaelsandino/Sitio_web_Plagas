<?php 

    include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];
    $fechaActual = date('d-m-Y');

    $review="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Permite saber cuantas filas tiene la consulta*/
    $check=mysqli_fetch_row($review);

    if (!$check) {
        echo 'invalid_user';
    }else{
        $update = "UPDATE plagas SET stado_p='En espera' WHERE id_plagas='$id_plagas'";
        $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        $insert = "INSERT INTO solicitud_plaga value(null,'$id_plagas','$fechaActual',null,'En espera',null,null)";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
        
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud de aval con exito - Se actualizara dentro un momento el listado de Plagas. 
            </div>';
         }
  
    }


    
    include("../../disconnect.php");

?>