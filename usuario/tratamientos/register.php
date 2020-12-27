
<?php 

include("../../connect.php");

$IdPlagas = $_POST['IdPlagas'];
$TpTratamiento = $_POST['TpTratamiento'];
$NaTratamiento = $_POST['NaTratamiento'];
$DesTratamiento = $_POST['DesTratamiento'];
/* Permite realizar el registro de la información de textos largos */
$DesTratamiento= mysqli_real_escape_string($connect,$DesTratamiento);

$insert = "INSERT INTO tratamiento value(null,'$IdPlagas','$TpTratamiento','$NaTratamiento','$DesTratamiento','Pendiente')";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');

        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información enviada con exito - Se actualizara dentro un momento el listado de tratamientos.  
                </div>';
        }

include("../../disconnect.php");

?>