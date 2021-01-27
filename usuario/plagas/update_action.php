<?php    

    include("../../connect.php");

    $id_plagas = $_POST['id_plagas'];
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

    /* Si no se coloco ninguna nueva imagen */
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
        /* Verificar el formato de la imagen */
        if (($photoA["type"] == "image/jpg" or $photoA["type"] == "image/jpeg" or $photoA["type"] == "image/png" or $photoA["type"] == "") and ($photoB["type"] == "image/jpg" or $photoB["type"] == "image/jpeg" or $photoB["type"] == "image/png" or  $photoB["type"] == "") and ($photoC["type"] == "image/jpg" or $photoC["type"] == "image/jpeg" or $photoC["type"] == "image/png" or $photoC["type"] == "") and ($photoD["type"] == "image/jpg" or $photoD["type"] == "image/jpeg" or $photoD["type"] == "image/png" or $photoD["type"] == "")) {

            $photos = "";
            $consult="SELECT * FROM plagas WHERE id_plagas='$id_plagas'";  
            $consult = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
            $namePhoto=mysqli_fetch_row($consult);
            $imagen_u = $namePhoto[6]; 
            $imagen_d = $namePhoto[7]; 
            $imagen_t = $namePhoto[8]; 
            $imagen_c = $namePhoto[9]; 
                
                if ($photoA["type"] == "image/jpg" or $photoA["type"] == "image/jpeg" or $photoA["type"] == "image/png") {

                    if ($photoA["type"] == "image/png") {

                        unlink($imagen_u); 
                        
                        $name_photoA = "a".$id_plagas.".png";
                        $routeA = "plagas_img/".$name_photoA;
                        move_uploaded_file($photoA["tmp_name"],$routeA);

                        $locationA = "plagas_img/".$name_photoA;
                        $photos = $photos.",imagen_u='$locationA'";

                    }else{

                        unlink($imagen_u); 
                        
                        $name_photoA = "a".$id_plagas.".jpg";
                        $routeA = "plagas_img/".$name_photoA;
                        move_uploaded_file($photoA["tmp_name"],$routeA);

                        $locationA = "plagas_img/".$name_photoA;
                        $photos = $photos.",imagen_u='$locationA'";

                    }
                    
                }
            
                if ($photoB["type"] == "image/jpg" or $photoB["type"] == "image/jpeg" or $photoB["type"] == "image/png") {

                    if ($photoB["type"] == "image/png") {

                        unlink($imagen_d); 
                    
                        $name_photoB = "b".$id_plagas.".png";
                        $routeB = "plagas_img/".$name_photoB;
                        move_uploaded_file($photoB["tmp_name"],$routeB);

                        $locationB = "plagas_img/".$name_photoB;
                        $photos = $photos.",imagen_d='$locationB'";

                    }else{

                        unlink($imagen_d); 
                    
                        $name_photoB = "b".$id_plagas.".jpg";
                        $routeB = "plagas_img/".$name_photoB;
                        move_uploaded_file($photoB["tmp_name"],$routeB);

                        $locationB = "plagas_img/".$name_photoB;
                        $photos = $photos.",imagen_d='$locationB'";
                    }
                    
                     
                }
            
                if ($photoC["type"] == "image/jpg" or $photoC["type"] == "image/jpeg" or $photoC["type"] == "image/png") {

                    if ($photoC["type"] == "image/png") {

                        unlink($imagen_t); 

                        $name_photoC = "c".$id_plagas.".png";
                        $routeC = "plagas_img/".$name_photoC;
                        move_uploaded_file($photoC["tmp_name"],$routeC);    
                        
                        $locationC = "plagas_img/".$name_photoC;
                        $photos = $photos.",imagen_t='$locationC'";

                    }else{

                        unlink($imagen_t); 

                        $name_photoC = "c".$id_plagas.".jpg";
                        $routeC = "plagas_img/".$name_photoC;
                        move_uploaded_file($photoC["tmp_name"],$routeC);    
                        
                        $locationC = "plagas_img/".$name_photoC;
                        $photos = $photos.",imagen_t='$locationC'";

                    }

                }
            
                if ($photoD["type"] == "image/jpg" or $photoD["type"] == "image/jpeg" or $photoD["type"] == "image/png") {

                    if ($photoD["type"] == "image/png") {
                        
                        unlink($imagen_c); 
                    
                        $name_photoD = "d".$id_plagas.".png";
                        $routeD = "plagas_img/".$name_photoD;
                        move_uploaded_file($photoD["tmp_name"],$routeD);        

                        $locationD = "plagas_img/".$name_photoD;
                        $photos = $photos.",imagen_c='$locationD'";

                    }else{

                        unlink($imagen_c); 
                    
                        $name_photoD = "d".$id_plagas.".jpg";
                        $routeD = "plagas_img/".$name_photoD;
                        move_uploaded_file($photoD["tmp_name"],$routeD);        

                        $locationD = "plagas_img/".$name_photoD;
                        $photos = $photos.",imagen_c='$locationD'";
                    } 

                }
 
                /* Actualizar */
                $update = "UPDATE plagas SET tp_plaga='$tipoPlaga', nombreT_plagas='$nameT',nombreC_plagas='$nameC',Descp_plagas='$descrip'$photos
                WHERE id_plagas='$id_plagas'";
                $result = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

                if($result){
                    echo '<div class="alert alert-success text-center mt-3" role="alert">
                    Información actualizada con exito - Sera redireccionado en un momento.
                    </div>';
                }  
        }else{
             echo '<div class="alert alert-danger text-center mt-3" role="alert">
                    El formato de alguna de las imagenes no es valida (Solo se acepta jpg o jpeg). 
                    </div>';
        }   
    }

    include("../../disconnect.php");
    
?>