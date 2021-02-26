<?php
/* Crear variables globales al momento de iniciar sesión*/
    include("../connect.php");

    $email = $_POST['email'];

    $consult="SELECT * FROM usuarioapp WHERE email='$email'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $check=mysqli_fetch_row($result);
    if ($check) {
        $rol = $check[7];

        session_start();
        ob_start();
        if (!isset($_SESSION['user'])){
            $_SESSION['user'] = $email;
            $_SESSION['rol'] = $rol;
        }
         
        echo $rol;
    }else{
        
        session_start();
        ob_start();
        if (!isset($_SESSION['user'])){
            $_SESSION['user'] = $email;
            $_SESSION['rol'] = 'usuario';
        }
    
    }

    include("../disconnect.php");

?>