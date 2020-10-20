<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "plagas2020";

    /* error_reporting(0); -> No genera errores */

    $connect = new mysqli($server,$user,$password,$database);

    if ( $connect->connect_errno) {
        echo "Nuestro sitio experimenta fallos...";
    exit();
    }

?>