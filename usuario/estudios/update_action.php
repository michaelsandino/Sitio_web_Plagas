<?php
    include("../../connect.php");

    session_start();
    ob_start();

    $id_usu = $_SESSION['user'];

    $idFormacion = $_POST['idFormacion'];

    $nvformativo = $_POST['nvformativo'];
    $titulo = $_POST['titulo'];
    $entidadEdu = $_POST['entidadEdu'];
    $fechGrado = $_POST['fechGrado'];
    $fechGrado = date("d-m-Y", strtotime($fechGrado));
    $pdf = $_FILES['pdf'];
    
    /* Si no se coloco un nuevo archivo para actualizar */
     if ($pdf["type"] == "") {

        $update = "UPDATE formacionapp SET nivelformativo='$nvformativo', tituloFormacion='$titulo',entidadEducativa='$entidadEdu',
        fechaGrado='$fechGrado' WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";
        
        $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información actualizada con éxito - Sera redireccionado en un momento.
            </div>';
        }  
        
    }else{

        /* Verificar el tipo de archivo */
        if ($pdf["type"] == "application/pdf") {

            /* ELIMINAR FOTO */
            $consult="SELECT * FROM formacionapp WHERE idFormacion='$idFormacion'";  
            $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            $nameFile=mysqli_fetch_row($consult);
            $nameFile = $nameFile[6];
            $nameFile = substr(strrchr($nameFile, "/"), 1);
        
            unlink('../../../archivoestudio/'.$nameFile); 

            /* Actualizar foto */
            $name_file = $idFormacion.".pdf";
            $route = "../../../archivoestudio/".$name_file;
            move_uploaded_file($pdf["tmp_name"],$route);

            /* VARIABLES IMPORTANTES PARA GUARDAR ARCHIVOS EN BD*/
            $dominio = $_SERVER [ 'SERVER_NAME' ];
            $folder = "/Plagas/archivoestudio/";
            $location = 'https://'.$dominio.$folder.$name_file;
            
            $update = "UPDATE formacionapp SET nivelformativo='$nvformativo', tituloFormacion='$titulo',entidadEducativa='$entidadEdu',
            fechaGrado='$fechGrado', soporte='$location' WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";
            
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información actualizada con éxito - Sera redireccionado en un momento.
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