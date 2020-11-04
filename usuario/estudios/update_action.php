<?php
    include("../../connect.php");

    $id_usu = $_POST['ideUsu'];
    $idFormacion = $_POST['id'];

    $nvformativo = $_POST['nvformativo'];
    $titulo = $_POST['titulo'];
    $entidadEdu = $_POST['entidadEdu'];
    $fechGrado = $_POST['fechGrado'];

    $update = "UPDATE formacionapp SET nivelformativo='$nvformativo', tituloFormacion='$titulo',entidadEducativa='$entidadEdu',
    fechaGrado='$fechGrado' WHERE id_usu='$id_usu' AND idFormacion='$idFormacion'";
    
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    include("../../disconnect.php");

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información actualizada con exito - Sera redireccionado en un momento.
        </div>';
    }  
?>