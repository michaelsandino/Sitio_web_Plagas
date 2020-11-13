<?php    

    include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
    $tipoPlaga = $_POST['tipoPlaga'];
	$nameT = $_POST['nameT'];
	$nameC = $_POST['nameC'];
	$descrip = $_POST['descrip'];
	$photoA = $_FILES['photoA'];
	$photoB = $_FILES['photoB'];
	$photoC = $_FILES['photoC'];
    $photoD = $_FILES['photoD'];

    if ($photoA["type"] == "" & $photoB["type"] == "" & $photoC["type"] == "" & $photoD["type"] == "") {

        $update = "UPDATE plagas SET tp_plaga='$tipoPlaga', nombreT_plagas='$nameT',nombreC_plagas='$nameC',Descp_plagas='$descrip'
        WHERE id_plagas='$id_plagas'";
        $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error - Revisar que la plaga seleccionada no tenga asignada una o mas tratamientos.</div>');
        
        if($result){
            echo '<div class="alert alert-success text-center mt-3" role="alert">
            Información actualizada con exito - Sera redireccionado en un momento.
            </div>';
        }  

    }else{

        $photos = "";
            
            if ($photoA["type"] == "image/jpg" or $photoA["type"] == "image/jpeg") {


                $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
                $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                while($view = mysqli_fetch_array($consult))
                {
                    unlink('plagas_img/'.$view['imagen_u']); 
                }

                $name_encripA = md5($photoA['tmp_name']).".jpg";
                $routeA = "plagas_img/".$name_encripA;
                move_uploaded_file($photoA["tmp_name"],$routeA);

                $photos = $photos.",imagen_u='$name_encripA'";
       
            }else if($photoA["type"] != ""){
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                El formato de imagen 1 no es valida (Solo se acepta jpg o jpeg)
                </div>';
            }
        
            if ($photoB["type"] == "image/jpg" or $photoB["type"] == "image/jpeg") {

                $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
                $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                while($view = mysqli_fetch_array($consult))
                {
                    unlink('plagas_img/'.$view['imagen_d']); 
                }

                $name_encripB = md5($photoB['tmp_name']).".jpg";
                $routeB = "plagas_img/".$name_encripB;
                move_uploaded_file($photoB["tmp_name"],$routeB);

                $photos = $photos.",imagen_d='$name_encripB'";
                
            }else if($photoB["type"] != ""){
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                El formato de imagen 2 no es valida (Solo se acepta jpg o jpeg)
                </div>';
            }
        
            if ($photoC["type"] == "image/jpg" or $photoC["type"] == "image/jpeg") {

                $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
                $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                while($view = mysqli_fetch_array($consult))
                {
                    unlink('plagas_img/'.$view['imagen_t']); 
                }

                $name_encripC = md5($photoC['tmp_name']).".jpg";
                $routeC = "plagas_img/".$name_encripC;
                move_uploaded_file($photoC["tmp_name"],$routeC);    
                
                $photos = $photos.",imagen_t='$name_encripC'";
                
            }elseif($photoC["type"] != ""){
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                El formato de imagen 3 no es valida (Solo se acepta jpg o jpeg)
                </div>';
            }
        
            if ($photoD["type"] == "image/jpg" or $photoD["type"] == "image/jpeg") {

                $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
                $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                while($view = mysqli_fetch_array($consult))
                {
                    unlink('plagas_img/'.$view['imagen_c']); 
                }

                $name_encripD = md5($photoD['tmp_name']).".jpg";
                $routeD = "plagas_img/".$name_encripD;
                move_uploaded_file($photoD["tmp_name"],$routeD);        

                $photos = $photos.",imagen_c='$name_encripD'";

            }else if($photoD["type"] != ""){
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                El formato de imagen 4 no es valida (Solo se acepta jpg o jpeg)
                </div>';
            }

            $update = "UPDATE plagas SET tp_plaga='$tipoPlaga', nombreT_plagas='$nameT',nombreC_plagas='$nameC',Descp_plagas='$descrip'$photos
            WHERE id_plagas='$id_plagas'";
            $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error - Revisar que la plaga seleccionada no tenga asignada una o mas tratamientos.</div>');
        
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Información actualizada con exito - Sera redireccionado en un momento.
                </div>';
            }  
    }


 




    include("../../disconnect.php");
    
?>