<?php

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $id_plagas = $_POST['id_plagas'];
    $idTratamiento = $_POST['idTratamiento'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $review="SELECT * FROM cultivo c, plagas p, tratamiento t WHERE 
    t.idTratamiento='$idTratamiento' AND t.id_plaga='$id_plagas' AND p.id_plagas='$id_plagas' AND
    c.idCultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo' AND c.idUsuCultivo='$idUsuCultivo'";  

    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    $check=mysqli_fetch_row($review);

    if (!$check){        
                            
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