<?php

    include("../../connect.php");

    $email = $_POST['email'];
    $cumplimiento = $_POST['cumplimiento'];
    $nota = $_POST['nota'];
    /* Permite realizar el registro de la información de textos largos */
    $nota= mysqli_real_escape_string($connect,$nota);

    /* Actualizar el estado de la solicitud */
    $update = "UPDATE solicitud_cuenta SET stado_s='$cumplimiento', Nota_s='$nota' WHERE idSolicitante='$email'";
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Actualizar el tipo de usuario si este fue admitido */
    if ($cumplimiento=='Admitido') {
        $update = "UPDATE usuarioapp SET tpUsuario='Admi' WHERE email='$email'";
        $result = mysqli_query($connect,$update) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');

        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud procesada con éxito - Sera redireccionado en un momento.
            </div>';
        }
    }else{
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Solicitud procesada con éxito - Sera redireccionado en un momento.
            </div>';
        }
    }
    
    

    

    include("../../disconnect.php");
?>