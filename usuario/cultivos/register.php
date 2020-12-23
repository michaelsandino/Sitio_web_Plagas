<?php 

    include("../../connect.php");

    $nameR = $_POST['nameR'];
    $nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
    $photo = $_FILES['photo'];
    $id_user = $_POST['id_user'];

    if ($photo["type"] == "image/jpg" or $photo["type"] == "image/jpeg") {
       
        $name_encrip = md5($photo['tmp_name']).".jpg";
        $route = "cultivos_img/".$name_encrip;
        move_uploaded_file($photo["tmp_name"],$route);

        $location = "https://plagas-app.emprendegrm.com/usuario/cultivos/cultivos_img/".$name_encrip;

        $insert = "INSERT INTO cultivo value(null,'$nameR','$nameC','$descrip','$id_user','$name_encrip','Pendiente','https://emprendegrm.com/Plagas/rasena.html')";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información enviada con exito - Se actualizara dentro un momento el listado de cultivos. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        El formato de la imagen no es valida
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }



    include("../../disconnect.php");

?>
