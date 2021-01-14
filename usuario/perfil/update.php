<?php
    include("../../connect.php");

    session_start();
    ob_start();

    $email = $_SESSION['user'];
    
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tp_id = $_POST['ti'];
    $identidad = $_POST['ni'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = $_POST['telefono'];

    $update = "UPDATE usuarioapp SET nameUsu='$name', apellidoUsu='$apellido',tp_id='$tp_id',
    identidad='$identidad',fechanacimiento='$fechanacimiento',telefono='$telefono' WHERE email='$email'";
    
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    include("../../disconnect.php");

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información actualizada con exito - Sera redireccionado en un momento.
        </div>';
    }

?>