<?php

    include("../../connect.php");

    $email = $_POST['email'];

    $consult="SELECT * FROM user WHERE email='$email'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while ($a = mysqli_fetch_assoc($result)) {
        $json=$a;
    }
    echo json_encode($json);

    include("../../disconnect.php");

?>