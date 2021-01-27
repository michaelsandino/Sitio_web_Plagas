<?php

    include("../../connect.php");

    $idTratamiento = $_POST['idTratamiento'];
    $TpTratamiento = $_POST['TpTratamiento'];
    $NaTratamiento = $_POST['NaTratamiento'];
    $DesTratamiento = $_POST['DesTratamiento'];
    /* Permite realizar el registro de la información de textos largos */
    $DesTratamiento= mysqli_real_escape_string($connect,$DesTratamiento);

    /* Actualizar información del tratamiento */
    $update = "UPDATE tratamiento SET tipoTratamiento='$TpTratamiento', nameTrata='$NaTratamiento',pasosTratamiento='$DesTratamiento' WHERE idTratamiento='$idTratamiento'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información actualizada con éxito - Sera redireccionado en un momento.
        </div>';
    }

    include("../../disconnect.php");
?>