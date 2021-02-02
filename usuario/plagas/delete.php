<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];

    /* Consultar que la plaga sea del usuario */
    $consult="SELECT * FROM cultivo c, plagas p WHERE c.idCultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo' AND p.id_plagas='$id_plagas' AND c.idUsuCultivo='$idUsuCultivo' AND (p.stado_p='Rechazado' OR p.stado_p='Pendiente')";  
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    $namePhoto=mysqli_fetch_row($consult);

    if ($namePhoto) {

        $delete = "DELETE FROM plagas WHERE id_plagas='$id_plagas'";
        $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">La plaga seleccionada no puede ser eliminada debido a que esta cuenta con uno o mas tratamientos registrados.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        $imagen_u = $namePhoto[14]; 
        $imagen_u = substr(strrchr($imagen_u, "/"), 1);
        $imagen_d = $namePhoto[15]; 
        $imagen_d = substr(strrchr($imagen_d, "/"), 1);
        $imagen_t = $namePhoto[16]; 
        $imagen_t = substr(strrchr($imagen_t, "/"), 1);
        $imagen_c = $namePhoto[17]; 
        $imagen_c = substr(strrchr($imagen_c, "/"), 1);
            
        unlink('../../../imgPlagas/'.$imagen_u); 
        unlink('../../../imgPlagas/'.$imagen_d); 
        unlink('../../../imgPlagas/'.$imagen_t); 
        unlink('../../../imgPlagas/'.$imagen_c); 
                 
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Plaga eliminada con éxito - Se actualizara dentro un momento el listado de plagas.
        </div>';        

    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        invalid_user
        </div>';   
    }

    include("../../disconnect.php");

?>

