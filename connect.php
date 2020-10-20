<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "emprende_plagas";

    /* error_reporting(0); -> No genera errores */

    $connect = new mysqli($server,$user,$password,$database);

    if ( $connect->connect_errno) {
        echo "Nuestro sitio experimenta fallos...";
    exit();
    }

?>