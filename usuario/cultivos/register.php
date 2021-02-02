<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $id_user = $_SESSION['user'];

    $nameR = $_POST['nameR'];
    $nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
    /* Permite realizar el registro de la información de textos largos */
    $descrip= mysqli_real_escape_string($connect,$descrip);
    $photo = $_FILES['photo'];

    /* Verificar que la imagen tenga el formato adecuado */
    if ($photo["type"] == "image/jpg" or $photo["type"] == "image/jpeg" or $photo["type"] == "image/png") {

        /* Consultar en que numero del auto_increment del id va en la table cultivos */
        $number = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'emprende_plagas' AND TABLE_NAME = 'cultivo'";
        $number = mysqli_query($connect,$number) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
        $number=mysqli_fetch_row($number);
        $number = $number[0]; 

        /* Guardar la imagen segun el tipo de formato */
        if ($photo["type"] == "image/png") {
            
            $name_photo = $number.".png";
            $route = "../../../ImgCultivo/".$name_photo;
            move_uploaded_file($photo["tmp_name"],$route);
        }else{
            $name_photo = $number.".jpg";
            $route = "../../../ImgCultivo/".$name_photo;
            move_uploaded_file($photo["tmp_name"],$route);
        }

        $dominio = $_SERVER [ 'SERVER_NAME' ];
        $location = $dominio."/Plagas/ImgCultivo/".$name_photo;

        $insert = "INSERT INTO cultivo value(null,'$nameR','$nameC','$descrip','$id_user','$location','Pendiente','https://emprendegrm.com/Plagas/rasena.html')";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información enviada con éxito - Se actualizara dentro un momento el listado de cultivos. 
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        El formato de la imagen no es valida.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }



    include("../../disconnect.php");

?>
