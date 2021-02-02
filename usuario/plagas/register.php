<?php    

    include("../../connect.php");

    $id_cultivo = $_POST['id_cultivo'];
    $tipoPlaga = $_POST['tipoPlaga'];
	$nameT = $_POST['nameT'];
	$nameC = $_POST['nameC'];
    $descrip = $_POST['descrip'];
    /* Permite realizar el registro de la información de textos largos */
    $descrip= mysqli_real_escape_string($connect,$descrip);
	$photoA = $_FILES['photoA'];
	$photoB = $_FILES['photoB'];
	$photoC = $_FILES['photoC'];
    $photoD = $_FILES['photoD'];
                
    /* Verificar el formato de la imagenes */
    if (($photoA["type"] == "image/jpg" or $photoA["type"] == "image/jpeg" or $photoA["type"] == "image/png")&($photoB["type"] == "image/jpg" or $photoB["type"] == "image/jpeg" or $photoB["type"] == "image/png")&($photoC["type"] == "image/jpg" or $photoC["type"] == "image/jpeg" or $photoC["type"] == "image/png")&($photoD["type"] == "image/jpg" or $photoD["type"] == "image/jpeg" or $photoD["type"] == "image/png")) {

        $number = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'emprende_plagas' AND TABLE_NAME = 'plagas'";
        $number = mysqli_query($connect,$number) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
        $number=mysqli_fetch_row($number);
        $number = $number[0]; 

        $dominio = $_SERVER [ 'SERVER_NAME' ];
        
        /* FOTO 1 */

        if ($photoA["type"] == "image/png") {

            $name_photoA = "a".$number.".png";
            $routeA = "../../../imgPlagas/".$name_photoA;
            move_uploaded_file($photoA["tmp_name"],$routeA);

            $locationA = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoA;

        }else{

            $name_photoA = "a".$number.".jpg";
            $routeA = "../../../imgPlagas/".$name_photoA;
            move_uploaded_file($photoA["tmp_name"],$routeA);

            $locationA = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoA;

        }
        /* FOTO 2 */

        if ($photoB["type"] == "image/png") {

            $name_photoB = "b".$number.".png";
            $routeB = "../../../imgPlagas/".$name_photoB;
            move_uploaded_file($photoB["tmp_name"],$routeB);

            $locationB = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoB;

        }else{

            $name_photoB = "b".$number.".jpg";
            $routeB = "../../../imgPlagas/".$name_photoB;
            move_uploaded_file($photoB["tmp_name"],$routeB);

            $locationB = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoB;

        }

        /* FOTO 3 */

        if ($photoC["type"] == "image/png") {

            $name_photoC = "c".$number.".png";
            $routeC = "../../../imgPlagas/".$name_photoC;
            move_uploaded_file($photoC["tmp_name"],$routeC);

            $locationC = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoC;

        }else{

            $name_photoC = "c".$number.".jpg";
            $routeC = "../../../imgPlagas/".$name_photoC;
            move_uploaded_file($photoC["tmp_name"],$routeC);

            $locationC = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoC;

        }

        /* FOTO 4 */

        if ($photoD["type"] == "image/png") {

            $name_photoD = "d".$number.".png";
            $routeD = "../../../imgPlagas/".$name_photoD;
            move_uploaded_file($photoD["tmp_name"],$routeD);

            $locationD = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoD;

        }else{

            $name_photoD = "d".$number.".jpg";
            $routeD = "../../../imgPlagas/".$name_photoD;
            move_uploaded_file($photoD["tmp_name"],$routeD);

            $locationD = 'https://'.$dominio."/Plagas/imgPlagas/".$name_photoD;
        }

        $insert = "INSERT INTO plagas value(null,'$id_cultivo','$tipoPlaga','$nameT','$nameC','$descrip','$locationA','$locationB','$locationC','$locationD','Pendiente','https://emprendegrm.com/Plagas/rasenaPlaga1.html')";
        $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error</div>');
    
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información enviada con exito - Se actualizara dentro un momento el listado de plagas.  
            </div>';
        }
    }else{
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        El formato de alguna de las imagenes no es valido.
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }            

    include("../../disconnect.php");
    
?>