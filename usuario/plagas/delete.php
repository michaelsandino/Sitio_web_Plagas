<?php

    include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    /* $consult="SELECT * FROM cultivo c,plagas p WHERE p.id_plagas='$id_plagas' AND c.idUsuCultivo='$idUsuCultivo' AND c.idcultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo'"; */
    $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    $delete = "DELETE FROM plagas WHERE id_plagas='$id_plagas'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">La plaga seleccionada no puede ser eliminada debido a que esta cuenta con uno o mas tratamientos registrados.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                                                                                                                
    if ($result) {

        $namePhoto=mysqli_fetch_row($consult);
        $imagen_u = $namePhoto[6]; 
        $imagen_d = $namePhoto[7]; 
        $imagen_t = $namePhoto[8]; 
        $imagen_c = $namePhoto[9]; 
            
        unlink('plagas_img/'.$imagen_u); 
        unlink('plagas_img/'.$imagen_d); 
        unlink('plagas_img/'.$imagen_t); 
        unlink('plagas_img/'.$imagen_c); 
                 
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Plaga eliminada con Exito - Se actualizara dentro un momento el listado de plagas.
        </div>';        

    }

    

        

    include("../../disconnect.php");

?>