
<?php 

    include("../../connect.php");

    $email = $_POST['email'];
	$name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ti = $_POST['ti'];
    $ni = $_POST['ni'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = $_POST['telefono'];

    $insert = "INSERT INTO usuarioapp value('$email','$ti','$ni','$name','$apellido','$fechanacimiento','$telefono','usuario')";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error - Revisa tu perfil</div>');
	
    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información enviada con exito - Sera redireccionado en un momento.
        </div>';
    }

?>


