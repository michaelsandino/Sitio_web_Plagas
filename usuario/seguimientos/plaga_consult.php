<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 
    $id_plagas = $_POST['id_plagas'];

    if ($user_rol == 'Admi') {

        /* Consultar información de la plaga */
        $consult="SELECT * FROM solicitud_plaga s, plagas p WHERE s.id_plagaSolict='$id_plagas' AND p.id_plagas='$id_plagas' ORDER BY s.id_solicPlag DESC LIMIT 2";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        $total = $result->num_rows;

        while($view = mysqli_fetch_array($result)){
            
            echo'
            <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nombreC_plagas'].'</p>
            <a href="solicitudes_tratamientos.php?plaga='.$view['id_plagas'].'" class="btn btn-secondary btn-sm edit position-absolute">Tratamientos <img src="../../icons/lupa.svg" height="18px" class="pl-2" alt="icono_lupa"></a>

                    <div class="row">

                        <div class="col-12 col-md-6 col-lg-7">
                        <p class="text text-left mx-3"><strong>Tipo:</strong> '.$view['tp_plaga'].' <br> 
                        <strong>Nombre científico:</strong> <em>'.$view['nombreC_plagas'].'</em></p>
                            
                        </div>

                        <div class="col-12 mb-2">
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
            ';

            /* Mostrar registro anterior en caso de haber sido rechazado */
            if ($total>1) {
                $previous=mysqli_fetch_row($result);
                $fecha = $previous[3]; 
                $estado = $previous[4]; 
                $nota = $previous[5]; 
                $evaluador = $previous[6]; 
                
                if ($view['stado_plag']=='Revisión' AND $view['evaluador_plag']==$user_email) {
                    echo '
                    <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicitud anterior</p>
                    <div class="col-12">
            
                        <p class="text px-1 mb-3"><strong>Estado: </strong>'.$estado.'.
                        <br><strong>Nota: </strong>'.$nota.'
                        <br><strong>Evaluador: </strong>'.$evaluador.'
                        <br><strong>Fecha: </strong>'.$fecha.'
                        </p>
                            
                    </div>
                    ';
                }
                
            }
            
            /* Formulario para saber si es el usuario es el encargado */
            if ($view['stado_plag']=='Revisión' AND $view['evaluador_plag']==$user_email) {
                    
                echo'
                <p class="text bg-orange text-white pl-3" id="nameR" style="height: 31px; font-size:20px;">Validar información</p>

                            <div class="col-12">

                                <p class="text font-weight-bold">¿La plaga cumple con la información necesaria para dar el aval?</p>

                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="cumplimiento" id="option1" value="si">
                                <label class="form-check-label cumplimiento_color" for="option1">
                                    Si
                                 </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="cumplimiento" id="option2" value="no">
                                <label class="form-check-label cumplimiento_color" for="option2">
                                     No
                                </label>
                                </div>
                                <small class="form-text text-danger" id="cumplimiento_error"></small>
                                <br>
                                <label class="font-weight-bold" for="nota">Nota</label>
                                <textarea class="form-control" id="nota" rows="3" name="nota"></textarea>
                                <div id="message"></div>
                                <button type="submit" class="btn btn-success btn-block mt-4" onclick="seguimiento_plaga('.$view['id_solicPlag'].');">Guardar</button>
                                
                            </div>
                ';

            /* Mensaje para los usuarios que no son los encargados pero ya se encuentra en revisión. */
            }else if($view['stado_plag']=='Revisión' AND $view['evaluador_plag']!=$user_email AND $view['evaluador_plag']!=null){

                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicitud en Revisión</p>
        
                        <div class="col-12">
        
                        <p class="text font-weight-bold">La solicitud se encuentra en revisión.</p>
                        
                        </div>
                ';

            /* Información de cuando ya fue revisado una solicitud */
            }else if($view['stado_plag']!='En espera' AND $view['stado_plag']!='Revisión'){
                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Información Aval</p>
        
                        <div class="col-12">
        
                        <p class="text px-3 mb-3"><strong>Estado: </strong>'.$view['stado_plag'].'.
                        <br><strong>Nota: </strong>'.$view['nota_plag'].'
                        <br><strong>Evaluador: </strong>'.$view['evaluador_plag'].'
                        <br><strong>Fecha: </strong>'.$view['fech_finPlag'].'
                        </p>
                        </div>
                ';

            /* Mensaje cuando no hay ningun jurado encargado de la solicitud */
            }else if($view['stado_plag']=='En espera'){
                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicutud sin jurado asignado</p>
        
                        <div class="col-12">
        
                            <p class="text font-weight-bold">La solicitud se encuentra en espera.</p>

                        </div>
                ';
            }

        }
        
    }else{
        echo'invalid_user';
    }
    

    include("../../disconnect.php");

?>