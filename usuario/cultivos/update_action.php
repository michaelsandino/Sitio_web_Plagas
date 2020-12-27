<?php
    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $id_user = $_POST['id_user'];

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
            Información actualizada con exito - Sera redireccionado en un momento.
            </div>';
        }  
        
    }else{

        if ($photo["type"] == "image/jpg" or $photo["type"] == "image/jpeg") {

            /* ELIMINAR FOTO */
            $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo'";  
            $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
           
            $namePhoto=mysqli_fetch_row($consult);
            $namePhoto = $namePhoto[5];
            unlink('cultivos_img/'.$namePhoto); 
            

            /* Actualizar foto */
       
            $name_encrip = md5($photo['tmp_name']).".jpg";
            $route = "cultivos_img/".$name_encrip;
            move_uploaded_file($photo["tmp_name"],$route);
            
            $update = "UPDATE cultivo SET nameRegional='$nameR', nameCientifico='$nameC',descripCultivo='$descrip',imagenC='$name_encrip'
            WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$id_user'";
            
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');
        
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información actualizada con exito - Sera redireccionado en un momento.
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

     
