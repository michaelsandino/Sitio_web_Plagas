
<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $id_usu = $_SESSION['user'];

    $nivelForm = $_POST['nvformativo'];
    $tituloForm = $_POST['titulo'];
    $entidad = $_POST['entidadEdu'];
    $fechagrado = $_POST['fechGrado'];
    $pdf = $_FILES['pdf'];

    /* Verificar que el formato del arvhi sea el correcto */
    if ($pdf["type"] == "application/pdf") {
       
        $name_encrip = md5($pdf['tmp_name']).".pdf";
        $route = "estudios_pdf/".$name_encrip;
        move_uploaded_file($pdf["tmp_name"],$route);
        
        $location = "https://plagas-app.emprendegrm.com/usuario/estudios/estudios_pdf/".$name_encrip;

        $insert = "INSERT INTO formacionapp value(null,'$nivelForm','$tituloForm','$entidad','$fechagrado','$id_usu','$name_encrip')";
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
