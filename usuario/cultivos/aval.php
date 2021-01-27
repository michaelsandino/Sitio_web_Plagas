<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $idCultivo = $_POST['idCultivo'];
    $fechaActual = date('d-m-Y');

    /* Actualizar el estado del cultivo */
    $update = "UPDATE cultivo SET stado_c='En espera' WHERE idCultivo='$idCultivo' AND idUsuCultivo='$idUsuCultivo'";
    $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    /* Permite saber la cantidad de filas que tuvieron cambios*/
    $check = $connect->affected_rows;

    if ($check==1) {

        /* Realizar el registro de la solicitud del cultivo */
        $insert = "INSERT INTO solicitud_proyecto value(null,'$idCultivo','$fechaActual',null,'En espera',null,null)";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud de aval con éxito - Se actualizara dentro un momento el listado de cultivos. 
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
            invalid_user
            </div>';
    }

    
    include("../../disconnect.php");

?>

