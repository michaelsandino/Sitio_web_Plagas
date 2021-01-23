<?php

include("../../connect.php");

session_start();
ob_start();

$user_rol = $_SESSION['rol']; 
$idUsuCultivo = $_SESSION['user'];

if ($user_rol=='Admi' OR $user_rol=='usuario'){

    $consult="SELECT * FROM cultivo WHERE idUsuCultivo='$idUsuCultivo'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while($view = mysqli_fetch_array($result))
    {
        echo 
        '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">

            <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameRegional'].'</p>

            <div class="row">
                <div class="col-11 col-md-5 col-lg-4 pr-0">
                    <img src="cultivos_img/'.$view['imagenC'].'" class="w-100 mx-3 mb-2" alt="imagen_cultivo">
                </div>

                <div class="col-12 col-md-6 col-lg-7">
                    <p class="text text-left mx-3"><strong>Nombre científico: </strong> <em>'.$view['nameCientifico'].'</em> </p>
                </div>

                <div class="col-12">
                    <p class="text mx-3">'.nl2br($view['descripCultivo']).'</p>
                </div>

            </div>

            <div class="btn-group edit position-absolute">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="max-height:320px; overflow-y:auto;"';

            /* Estado por defecto */
            if('Pendiente'==$view['stado_c']) {

                /* Consulta para saber si el cultivo cuanta con almenos 1 plaga y 1 tratamiento */
                $review="SELECT id_plagas FROM cultivo c, plagas p WHERE p.id_cultivo='$view[idCultivo]' AND c.idCultivo='$view[idCultivo]' AND c.idUsuCultivo='$idUsuCultivo'";
                $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                $plagas= $connect->affected_rows;

                if ($plagas>0) {

                    for ($i=1; $i <= $plagas; $i++) { 

                        $plaga=mysqli_fetch_row($review);
                        $plaga = $plaga[0];

                        $review_two="SELECT * FROM tratamiento WHERE id_plaga='$plaga'"; 
                        $review_two = mysqli_query($connect,$review_two) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

                        $check=mysqli_fetch_row($review_two);

                        if ($check) {

                            $i = $plagas;

                            echo 
                            '<br> <button class="dropdown-item" onclick="aval('.$view['idCultivo'].');"><img src="../../icons/aval.svg" alt="icono_aval" class="pr-2" height="20px">Solicitar Aval</button>
                            <a class="dropdown-item" href="actualizar.php?cultivo='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_actualizar" class="pr-2" height="20px">Actualizar</a>
                            <button class="dropdown-item" onclick="eliminar('.$view['idCultivo'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                            <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                            </div>
                            </div>
                    
                        </div>';
                        }
                        else if ($i == $plagas){
                            echo 
                            '<br> <a class="dropdown-item" href="actualizar.php?cultivo='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_actualizar" class="pr-2" height="20px">Actualizar</a>
                            <button class="dropdown-item" onclick="eliminar('.$view['idCultivo'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                            <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                            </div>
                            </div>
                    
                        </div>';
                        }

                    }
                }else{
                    echo 
                    '<br> <a class="dropdown-item" href="actualizar.php?cultivo='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_actualizar" class="pr-2" height="20px">Actualizar</a>
                    <button class="dropdown-item" onclick="eliminar('.$view['idCultivo'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                    <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                    </div>
                    </div>
                    
                </div>';
                }

            /* Estado al momento de socitar aval */
            }else if('En espera'==$view['stado_c']){
                echo
                '<br> <button class="dropdown-item disabled"><img src="../../icons/espera.svg" alt="icono_aval" class="pr-2" height="20px">Pendiente de verificación</button> <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                </div>
                </div>

            </div>';
            
            }else if('Rechazado'==$view['stado_c'] or 'Activo'==$view['stado_c']){

                $nota="SELECT * FROM solicitud_proyecto WHERE id_cultivofk='$view[idCultivo]'";  
                $nota = mysqli_query($connect,$nota) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

                $nota_plag=mysqli_fetch_row($nota);
                $nota_plag = $nota_plag[5]; 

                if (!$nota_plag) {
                    $nota_plag = 'Sin Observaciones.';
                }

                /* Estado al ser rechazado */
                if('Rechazado'==$view['stado_c']){

                    echo 
                    '<br> <button class="dropdown-item" onclick="repeat_aval('.$view['idCultivo'].');"><img src="../../icons/rechazada.svg" alt="icono_aval" class="pr-2" height="20px">Rechazado / Solicitar de nuevo</button>
                    <a class="dropdown-item" href="actualizar.php?cultivo='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_actualizar" class="pr-2" height="20px">Actualizar</a>
                    <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                    <div class="dropdown-divider"></div>
                    <p class="mx-4 my-2 font-weight-bold small">Obervaciones:</p>
                    <p class="text-break text mx-4 mb-1 small" style="width:400px;"> '.nl2br($nota_plag).'</p>
                    </div>
                    </div>

                </div>';
                }
            
                /* Estado al ser aceptada */
                if('Activo'==$view['stado_c']){

                    echo 
                    '<br> <p class="dropdown-item disabled"><img src="../../icons/verificado.svg" alt="icono_aval" class="pr-2" height="20px">Verificado</p> <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../plagas/?cultivo='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_plagasr" class="pr-2" height="20px">Plagas</a>
                    <div class="dropdown-divider"></div>
                    <p class="mx-4 my-2 font-weight-bold small">Obervaciones:</p>
                    <p class="text-break text mx-4 mb-1 small" style="width:400px;"> '.nl2br($nota_sp).'</p>
                    </div>
                    </div>

                </div>';
                }
            }
            
    }
}else{
    echo'invalid_user';
}




include("../../disconnect.php");


?>