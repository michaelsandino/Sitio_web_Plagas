<?php
    include("../../connect.php");


    session_start();
    ob_start();

    $id_user = $_SESSION['user'];

    $id_cultivo = $_POST['id_cultivo'];

    $nameR = $_POST['nameR'];
    $nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
    /* Permite realizar el registro de la información de textos largos */
    $descrip= mysqli_real_escape_string($connect,$descrip);
    $photo = $_FILES['photo'];


    if ($photo["type"] == "") {

        $update = "UPDATE cultivo SET nameRegional='$nameR', nameCientifico='$nameC',descripCultivo='$descrip'
        WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$id_user'";
        
        $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información actualizada con éxito - Sera redireccionado en un momento.
            </div>';
        }  
        
    }else{

        if ($photo["type"] == "image/jpg" or $photo["type"] == "image/jpeg" or $photo["type"] == "image/png") {

            /* ELIMINAR FOTO */
            $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo'";  
            $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
           
            $namePhoto=mysqli_fetch_row($consult);
            $namePhoto = $namePhoto[5];
            unlink($namePhoto); 
            
            /* Actualizar foto */
            if ($photo["type"] == "image/png") {
                $name_photo = $id_cultivo.".png";
                $route = "cultivos_img/".$name_photo;
                move_uploaded_file($photo["tmp_name"],$route);
                $location = 'cultivos_img/'.$name_photo;
            }else{
                $name_photo = $id_cultivo.".jpg";
                $route = "cultivos_img/".$name_photo;
                move_uploaded_file($photo["tmp_name"],$route);
                $location = 'cultivos_img/'.$name_photo;
            }
            
            $update = "UPDATE cultivo SET nameRegional='$nameR', nameCientifico='$nameC',descripCultivo='$descrip',imagenC='$location'
            WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$id_user'";
            
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
        
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información actualizada con éxito - Sera redireccionado en un momento.
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

    }

    include("../../disconnect.php");



        

?>

     
