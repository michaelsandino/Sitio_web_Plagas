<?php
    include("../../connect.php");

    $email = $_POST['email'];
    $name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ti = $_POST['ti'];
    $ni = $_POST['ni'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = $_POST['telefono'];

    $update = "UPDATE usuarioapp SET nameUsu='$name', apellidoUsu='$apellido',ti='$ti',
    ni='$ni',fechanacimiento='$fechanacimiento',telefono='$telefono' WHERE email='$email'";
    
    $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    include("../../disconnect.php");

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información actualizada con exito - Sera redireccionado en un momento.
        </div>';
    }

?>