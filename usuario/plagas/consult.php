<?php

include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_cultivo = $_POST['id_cultivo'];

    $review="SELECT * FROM cultivo WHERE idCultivo='$id_cultivo' AND idUsuCultivo='$idUsuCultivo'";
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $check=mysqli_fetch_row($review);

    if (!$check) {
        echo 'invalid_user';
    }else{

        $consult="SELECT * FROM plagas WHERE id_cultivo='$id_cultivo'";
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
        while($view = mysqli_fetch_array($result))
        {
            echo 
            '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">
        
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nombreT_plagas'].'</p>
        
                <div class="row">
        
                    <div class="col-12">
                        <p class="text text-left mx-3"><strong>Tipo:</strong> '.$view['tp_plaga'].' <br> 
                        <strong>Nombre científico:</strong> <em>'.$view['nombreC_plagas'].'</em></p>
                    </div>
        
                    <div class="col-12">
                        <p class="text mx-3">'.nl2br($view['Descp_plagas']).'</p>
                        
                        <button class="btn btn-light border boton" type="button" data-toggle="collapse" data-target="#img'.$view['id_plagas'].'" aria-expanded="false" aria-controls="collapseExample">
                            Ver imagenes
                        </button>
                        
                        <div class="collapse center_container" id="img'.$view['id_plagas'].'">
                
                        <img src="'.$view['imagen_u'].'" class="plag_image" alt="imagen_plaga">
                        <img src="'.$view['imagen_d'].'" class="plag_image" alt="imagen_plaga">
                        <img src="'.$view['imagen_t'].'" class="plag_image" alt="imagen_plaga">
                        <img src="'.$view['imagen_c'].'" class="plag_image" alt="imagen_plaga">
                
                        </div>
                    </div>
        
                </div>
        
        
                <div class="btn-group edit position-absolute">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opciones
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="max-height:320px; overflow-y:auto;"';

                /* Estado por defecto */
                if('Pendiente'==$view['stado_p']) {
        
                    /* Consulta para saber si la plaga tiene el cultivo activo*/
                    $review="SELECT * FROM tratamiento WHERE id_plaga='$view[id_plagas]'";
                    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
                    $check=mysqli_fetch_row($review);
                    
                    if (!$check){        

                        echo
                        '<br> <a class="dropdown-item" href="actualizar.php?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
                        <button class="dropdown-item" onclick="eliminar('.$view['id_plagas'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                        <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
                        </div>
                        </div>
                
                    </div>';
        
                    }else{
        
                        echo
                        '<br> <button class="dropdown-item" onclick="aval('.$view['id_plagas'].');"><img src="../../icons/aval.svg" alt="icono_aval" class="pr-2" height="20px">Solicitar Aval</button>
                        <a class="dropdown-item" href="actualizar.php?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
                        <button class="dropdown-item" onclick="eliminar('.$view['id_plagas'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
                        <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
                        </div>
                        </div>
                
                    </div>';
                    }
                    
                /* Estado al momento de socitar aval */
                }else if('En espera'==$view['stado_p']){
                    echo
                    '<br> <button class="dropdown-item disabled"><img src="../../icons/espera.svg" alt="icono_aval" class="pr-2" height="20px">Pendiente de verificación</button> <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
                    </div>
                    </div>
        
                </div>';
                
                }else if('Rechazado'==$view['stado_p'] or 'Activo'==$view['stado_p']){
        
                    $nota="SELECT * FROM solicitud_plaga WHERE id_plagaSolict='$view[id_plagas]'";  
                    $nota = mysqli_query($connect,$nota) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
                    $nota_plag=mysqli_fetch_row($nota);
                    $nota_plag = $nota_plag[5]; 

                    if (!$nota_plag) {
                        $nota_plag = 'Sin Observaciones.';
                    }
        
                    /* Estado al ser rechazado */
                    if('Rechazado'==$view['stado_p']){
        
                        echo 
                        '<br> <button class="dropdown-item" onclick="repeat_aval('.$view['id_plagas'].');"><img src="../../icons/rechazada.svg" alt="icono_aval" class="pr-2" height="20px">Rechazado / Solicitar de nuevo</button>
                        <a class="dropdown-item" href="actualizar.php?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
                        <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
                        <div class="dropdown-divider"></div>
                        <p class="mx-4 my-2 font-weight-bold small">Obervaciones:</p>
                        <p class="text-break text mx-4 mb-1 small" style="width:400px;"> '.nl2br($nota_plag).'</p>
                        </div>
                        </div>
        
                    </div>';
                    }
                
                    /* Estado al ser aceptada */
                    if('Activo'==$view['stado_p']){
        
                        echo 
                        '<br> <button class="dropdown-item disabled"><img src="../../icons/verificado.svg" alt="icono_aval" class="pr-2" height="20px">Verificado</button> <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'&cultivo='.$view['id_cultivo'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
                        <div class="dropdown-divider"></div>
                        <p class="mx-4 my-2 font-weight-bold small">Obervaciones:</p>
                        <p class="text-break text mx-4 mb-1 small" style="width:400px;"> '.nl2br($nota_plag).'</p>
                        </div>
                        </div>
        
                    </div>';
                    }
                }

        }

    }


include("../../disconnect.php");


?>
