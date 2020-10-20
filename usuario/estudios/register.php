
<?php 

    include("../../connect.php");

    $nivelForm = $_POST['nvformativo'];
    $tituloForm = $_POST['titulo'];
    $entidad = $_POST['entidadEdu'];
    $fechagrado = $_POST['fechGrado'];
    $IdUsuario = $_POST['ideUsu'];

    $insert = "INSERT INTO formacionapp value(null,'$nivelForm','$tituloForm','$entidad','$fechagrado','$IdUsuario',null)";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
	
    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información enviada con exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }

    include("../../disconnect.php");
    
?>


