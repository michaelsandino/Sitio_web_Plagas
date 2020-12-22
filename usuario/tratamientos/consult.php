<?php

include("../../connect.php");

    $id_plaga = $_POST['id_plaga'];
    $idUsuCultivo = $_POST['idUsuCultivo'];

    $consult="SELECT * FROM plagas p,tratamiento t WHERE t.id_plaga='$id_plaga' AND p.id_plagas='$id_plaga'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
    while($view = mysqli_fetch_array($result))
            {
                $cultivo = $view['id_cultivo']; 
                $review="SELECT * FROM cultivo c, plagas p WHERE p.id_cultivo='$id_cultivo' AND p.idCultivo='$id_cultivo' AND c.idCultivo='$id_cultivo' AND c.idUsuCultivo='$idUsuCultivo'";  
                $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                
                echo 
                '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">

                    <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameTrata'].'</p>

                    <div class="row">
                        <div class="col-5 col-lg-4 pr-0">
                            <img src="cultivos_img/'.$view['imagenC'].'" class="w-100 ml-3" alt="imagen_cultivo">
                        </div>

                        <div class="col-6 col-lg-7">
                            <p class="text text-left mx-3">Nombre científicio: <br>'.$view['tipoTratamiento'].'</p>
                        </div>

                        <div class="col-12">
                            <p class="text mx-3">'.$view['pasosTratamiento'].'</p>
                        </div>

                    </div>

                    <div class="btn-group edit position-absolute">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="actualizar.html?tratamiento='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
                        <button class="dropdown-item" onclick="eliminar('.$view['idCultivo'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                    </div>
                    </div>

                    

                </div>';
            }

include("../../disconnect.php");

?>