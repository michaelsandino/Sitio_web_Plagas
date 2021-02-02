
<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $id_usu = $_SESSION['user'];

    $nivelForm = $_POST['nvformativo'];
    $tituloForm = $_POST['titulo'];
    $entidad = $_POST['entidadEdu'];
    $fechagrado = $_POST['fechGrado'];
    $fechagrado = date("d-m-Y", strtotime($fechagrado));
    $pdf = $_FILES['pdf'];

    /* Verificar que el formato del arvhi sea el correcto */
    if ($pdf["type"] == "application/pdf") {

        /* Consultar en que numero del auto_increment del id va en la table cultivos */
        $number = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'emprende_plagas' AND TABLE_NAME = 'formacionapp'";
        $number = mysqli_query($connect,$number) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
        $number=mysqli_fetch_row($number);
        $number = $number[0]; 
        
        $name_file = $number.".pdf";
        $route = "../../../archivoestudio/".$name_file;
        move_uploaded_file($pdf["tmp_name"],$route);

        $dominio = $_SERVER [ 'SERVER_NAME' ];
        $location = 'https://'.$dominio."/Plagas/archivoestudio/".$name_file;

        $insert = "INSERT INTO formacionapp value(null,'$nivelForm','$tituloForm','$entidad','$fechagrado','$id_usu','$location')";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
        
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información enviada con éxito - Se actualizara dentro un momento el listado de estudios.  
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        El formato del archivo no es valida.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }

    include("../../disconnect.php");
    
?>
