<?php

    include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

        $consult="SELECT * FROM cultivo c,plagas p WHERE p.id_plagas='$id_plagas' AND c.idUsuCultivo='$idUsuCultivo' AND c.idcultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo'";
        $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

        while($view = mysqli_fetch_array($consult))
        {
            unlink('plagas_img/'.$view['imagen_u']); 
            unlink('plagas_img/'.$view['imagen_d']); 
            unlink('plagas_img/'.$view['imagen_t']); 
            unlink('plagas_img/'.$view['imagen_c']); 

            if ($view['idUsuCultivo']) {
                $delete = "DELETE FROM plagas WHERE id_plagas='$id_plagas'";
                $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error - Revisar que la plaga seleccionada no tenga asignada una o mas tratamientos.</div>');

                
                if ($result){
                    echo '<div class="alert alert-success text-center mt-3" role="alert">
                    Plaga eliminada con Exito - - Se actualizara dentro un momento el listado de plagas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                } 
            }
        }

        

    include("../../disconnect.php");

?>