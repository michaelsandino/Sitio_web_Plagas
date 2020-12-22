
<?php 

    include("../../connect.php");

    $nivelForm = $_POST['nvformativo'];
    $tituloForm = $_POST['titulo'];
    $entidad = $_POST['entidadEdu'];
    $fechagrado = $_POST['fechGrado'];
    $pdf = $_FILES['pdf'];
    $id_user = $_POST['id_user'];

    if ($pdf["type"] == "application/pdf") {
       
        $name_encrip = md5($pdf['tmp_name']).".pdf";
        $route = "estudios_pdf/".$name_encrip;
        move_uploaded_file($pdf["tmp_name"],$route);

        /* GUARDAR EN LA BASE DE DATOS LA DIRECCION URL EN QUE SE ENCUENTRA EL ARCHIVO/IMAGEN */
        /* AL REALIZAR ESTO MEDIANTE LA URL SE DEBEN HACER CAMBIOS EN TODOS LOS REGISTER, CONSULT, UPDATE, UPDATE_ACTION Y DELETE */
        
        $location = "https://plagas-app.emprendegrm.com/usuario/estudios/estudios_pdf/".$name_encrip;
        /* PRESTAR ATENCIÓN EN LA PARTE DE LOCATION, TALVES SE DEBE COLOCAR AL FINAL .".pdf" */

        $insert = "INSERT INTO formacionapp value(null,'$nivelForm','$tituloForm','$entidad','$fechagrado','$id_user','$name_encrip')";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
        
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información enviada con exito.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
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


