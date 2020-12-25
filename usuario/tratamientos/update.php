<?php

    include("../../connect.php");

    $idTratamiento = $_POST['idTratamiento'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $review="SELECT * FROM tratamiento WHERE idTratamiento='$idTratamiento'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $review=mysqli_fetch_row($review);
    $id_plaga = $review[1]; 

    $review="SELECT * FROM plagas p,tratamiento t WHERE t.id_plaga='$id_plaga' AND p.id_plagas='$id_plaga'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
    $review=mysqli_fetch_row($review);
    $cultivo = $review[1]; 
            
    $review="SELECT * FROM cultivo c, plagas p WHERE p.id_cultivo='$cultivo' AND c.idCultivo='$cultivo' AND c.idUsuCultivo='$idUsuCultivo'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    $review=mysqli_fetch_row($review);

    if (!$review){        
                            
        echo 'invalid_user';

    }else{

        $consult="SELECT * FROM tratamiento WHERE idTratamiento='$idTratamiento'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
        while ($a = mysqli_fetch_assoc($result)) {
            $json=$a;
        }

        echo json_encode($json);
    }

    

    include("../../disconnect.php");

?>