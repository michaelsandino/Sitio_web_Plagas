<?php
    include("../../connect.php");

    $id_usu = $_POST['id_usu'];
    $idFormacion = $_POST['idFormacion'];

    $nvformativo = $_POST['nvformativo'];
    $titulo = $_POST['titulo'];
    $entidadEdu = $_POST['entidadEdu'];
    $fechGrado = $_POST['fechGrado'];
    $pdf = $_FILES['pdf'];
    

     if ($pdf["type"] == "") {

        $update = "UPDATE formacionapp SET nivelformativo='$nvformativo', tituloFormacion='$titulo',entidadEducativa='$entidadEdu',
        fechaGrado='$fechGrado' WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";
        
        $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información actualizada con exito - Sera redireccionado en un momento.
            </div>';
        }  
        
    }else{

        if ($pdf["type"] == "application/pdf") {

            /* ELIMINAR FOTO */
            $consult="SELECT * FROM formacionapp WHERE idFormacion='$idFormacion'";  
            $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
           
            $nameFile=mysqli_fetch_row($consult);
            $nameFile = $nameFile[6];
            unlink('estudios_pdf/'.$nameFile); 

            /* Actualizar foto */
       
            $name_encrip = md5($pdf['tmp_name']).".pdf";
            $route = "estudios_pdf/".$name_encrip;
            move_uploaded_file($pdf["tmp_name"],$route);
            
            $update = "UPDATE formacionapp SET nivelformativo='$nvformativo', tituloFormacion='$titulo',entidadEducativa='$entidadEdu',
            fechaGrado='$fechGrado', soporte='$name_encrip' WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";
            
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información actualizada con exito - Sera redireccionado en un momento.
                </div>';
            }  
    
        }else{
            echo '<div class="alert alert-danger text-center mt-3" role="alert">
            El formato del archivo no es valida
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
    }

    include("../../disconnect.php");
?>