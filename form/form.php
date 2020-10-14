
<?php 

    include("../connect.php");

    $email = $_POST['email'];
	$name = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ti = $_POST['ti'];
    $ni = $_POST['ni'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = $_POST['telefono'];

    $insert = "INSERT INTO user value('$email','$name','$apellido','$ti','$ni','$fechanacimiento','$telefono')";

    $result = mysqli_query($connect,$insert);

    include("../disconnect.php");

    if (!$result) {
        echo '<script type="text/javascript">alert("Error"); window.location="../form";</script>';
    } else {
        echo '<script type="text/javascript">alert("Información guardada con exito"); window.location="../usuario";</script>';
    }

?>