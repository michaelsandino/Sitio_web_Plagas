<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $id_usu = $_SESSION['user'];

    $idFormacion = $_POST['idFormacion'];
   
    /* Consultar ubicación y nombre del archivo del estudio */
    $consult="SELECT * FROM formacionapp WHERE idFormacion='$idFormacion' AND id_usu='$id_usu'";
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    /* Eliminar el archivo */
    $nameFile=mysqli_fetch_row($consult);
    $nameFile = $nameFile[6];
    $nameFile = substr(strrchr($nameFile, "/"), 1);

    unlink('../../../archivoestudio/'.$nameFile); 
    
    $delete = "DELETE FROM formacionapp WHERE idFormacion='$idFormacion' AND id_usu='$id_usu'";
    $result = mysqli_query($connect,$delete) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    if ($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Estudio eliminado con éxito - Se actualizara dentro un momento el listado de estudios.
        </div>';
    } 

    include("../../disconnect.php");

?>