<?php

    include("../connect.php");

    $email = $_POST['email'];

    $consult="SELECT * FROM usuarioapp WHERE email='$email'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $check=mysqli_fetch_row($result);
    if ($check) {
        $rol = $check[7];

        session_start();
        ob_start();
        $_SESSION['user'] = $email;
        $_SESSION['rol'] = $rol;

        echo $rol;
    }else{
        session_start();
        ob_start();
        $_SESSION['user'] = $email;
        $_SESSION['rol'] = 'usuario';
    }

    /* while($view = mysqli_fetch_array($result))
    {
        $user = $view['email']; 
        echo $user;
    } */

    include("../disconnect.php");

?>