<?php

    include("../../connect.php");

    $idTratamiento = $_POST['idTratamiento'];
    $id_plaga = $_POST['id_plaga'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];
            
    $review="SELECT * FROM cultivo c, plagas p WHERE p.id_cultivo='$id_cultivo' AND c.idCultivo='$id_cultivo' AND p.id_plagas='$id_plaga' AND c.idUsuCultivo='$idUsuCultivo'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    /* Permite saber cuantas filas tiene la consulta*/
    $check=mysqli_fetch_row($review);
          
        if (!$check){ 
            
            $delete = "DELETE FROM tratamiento WHERE idTratamiento='$idTratamiento'";
            $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            if ($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Tratamiento eliminado con Exito - Se actualizara dentro un momento el listado de Tratamientos.
                </div>';
            } 
        }else{
            echo '<div class="alert alert-danger text-center mt-3" role="alert">
            invalid_user
            </div>';    
        }
   
    

    include("../../disconnect.php");

?>