<?php

include("../../connect.php");

    $id_plaga = $_POST['id_plaga'];
    $id_cultivo = $_POST['id_cultivo'];
    $idUsuCultivo = $_POST['idUsuCultivo'];
            
    $review="SELECT * FROM cultivo c, plagas p WHERE p.id_cultivo='$id_cultivo' AND c.idCultivo='$id_cultivo' AND p.id_plagas='$id_plaga' AND c.idUsuCultivo='$idUsuCultivo'";  
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    $check=mysqli_fetch_row($review);
          
        if (!$check){        
                            
            echo 'invalid_user';

        }else{

            $consult="SELECT * FROM tratamiento WHERE id_plaga='$id_plaga'";  
            $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
            while($view = mysqli_fetch_array($result)){
                            
                echo 
                '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">
 
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameTrata'].'</p>

                    <div class="row">

                        <div class="col-12">
                            <p class="text text-left mx-3"><strong>Tipo de tratamiento</strong>: <br>'.$view['tipoTratamiento'].'</p>
                        </div>

                        <div class="col-12">
                            <p class="text mx-3"><strong>Pasos a seguir</strong>: <br>'.$view['pasosTratamiento'].'</p>
                        </div>    

                    </div>

                    <div class="btn-group edit position-absolute">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="actualizar.php?tratamiento='.$view['idTratamiento'].'&plaga='.$id_plaga.'&cultivo='.$id_cultivo.'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
                            <button class="dropdown-item" onclick="eliminar('.$view['idTratamiento'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                        </div>
                    </div>

                </div>';
            }

        }
                    
            

include("../../disconnect.php");

?>