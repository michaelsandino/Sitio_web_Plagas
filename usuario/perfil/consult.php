<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $email = $_SESSION['user'];

    $consult="SELECT * FROM usuarioapp WHERE email='$email'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

    include("../../disconnect.php");

?>