<?php
    if (isset($_POST["env"])) {

        include("../connect.php");

        $email = $_POST['email'];
        $name = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $ti = $_POST['ti'];
        $ni = $_POST['ni'];
        $fechanacimiento = $_POST['fechanacimiento'];
        $telefono = $_POST['telefono'];

        $update = "UPDATE user SET name='$name', apellido='$apellido',ti='$ti',
        ni='$ni',fechanacimiento='$fechanacimiento',telefono='$telefono' WHERE email='$email'";
    
        $result = mysqli_query($connect,$update);

        include("../disconnect.php");
        if (!$result) {
            echo "<script type=\"text/javascript\">alert(\"Error\"); window.location=\"update.php?update=$email\";</script>";
        } else {
            echo "<script type=\"text/javascript\">alert(\"Información Actualizada con Exito\"); window.location=\"../perfil/?search=$email\";</script>";
        }
    }

?>