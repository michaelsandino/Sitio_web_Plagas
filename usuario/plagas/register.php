<?php    

    include("../../connect.php");

    $idUsuCultivo = $_POST['idUsuCultivo'];
    $id_cultivo = $_POST['id_cultivo'];
    $tipoPlaga = $_POST['tipoPlaga'];
	$nameT = $_POST['nameT'];
	$nameC = $_POST['nameC'];
	$descrip = $_POST['descrip'];
	$photoA = $_FILES['photoA'];
	$photoB = $_FILES['photoB'];
	$photoC = $_FILES['photoC'];
    $photoD = $_FILES['photoD'];

    $consult="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";
    $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

    while($view = mysqli_fetch_array($consult))
        {
            if ($view['nameRegional']) {
                
                if (($photoA["type"] == "image/jpg" or $photoA["type"] == "image/jpeg")&($photoB["type"] == "image/jpg" or $photoB["type"] == "image/jpeg")&($photoC["type"] == "image/jpg" or $photoC["type"] == "image/jpeg")&($photoD["type"] == "image/jpg" or $photoD["type"] == "image/jpeg")) {
       
                    $name_encripA = md5($photoA['tmp_name']).".jpg";
                    $routeA = "plagas_img/".$name_encripA;
                    move_uploaded_file($photoA["tmp_name"],$routeA);
            
                    $name_encripB = md5($photoB['tmp_name']).".jpg";
                    $routeB = "plagas_img/".$name_encripB;
                    move_uploaded_file($photoB["tmp_name"],$routeB);
            
                    $name_encripC = md5($photoC['tmp_name']).".jpg";
                    $routeC = "plagas_img/".$name_encripC;
                    move_uploaded_file($photoC["tmp_name"],$routeC);
            
                    $name_encripD = md5($photoD['tmp_name']).".jpg";
                    $routeD = "plagas_img/".$name_encripD;
                    move_uploaded_file($photoD["tmp_name"],$routeD);
            
                    $insert = "INSERT INTO plagas value(null,'$id_cultivo','$tipoPlaga','$nameT','$nameC','$descrip','$name_encripA','$name_encripB','$name_encripC','$name_encripD')";
                    $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
                
                    if($result){
                        echo '<div class="alert alert-success text-center mt-3" role="alert">
                        Información enviada con exito - Se actualizara dentro un momento el listado de plagas.  
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                    }
                }else{
                    echo '<div class="alert alert-danger text-center mt-3" role="alert">
                    El formato de alguna de las imagenes no es valida (Solo se acepta jpg o jpeg)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }            

            }
            
        }


    include("../../disconnect.php");
    
?>