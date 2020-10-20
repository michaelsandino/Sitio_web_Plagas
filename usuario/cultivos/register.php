<?php 

    include("../../connect.php");

    $nameR = $_POST['nameR'];
    $nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
    $id = $_POST['id'];

    $insert = "INSERT INTO cultivo value(null,'$nameR','$nameC','$descrip','$id',null)";
    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');

    if($result){
        echo '<div class="alert alert-success text-center mt-3" role="alert">
        Información enviada con exito
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }

    include("../../disconnect.php");

?>
